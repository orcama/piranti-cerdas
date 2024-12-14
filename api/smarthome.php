<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tugas2pirdas";
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Log file untuk debugging
$log_file = 'debug_log.txt';

// Fungsi untuk menulis log
function writeLog($message) {
    global $log_file;
    file_put_contents($log_file, date('[Y-m-d H:i:s] ') . $message . PHP_EOL, FILE_APPEND);
}

// Periksa apakah data GET tersedia
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Log semua parameter yang diterima
    writeLog("Received parameters: " . print_r($_GET, true));
    
    $angleX = isset($_GET['anglex']) ? floatval($_GET['anglex']) : null;
    $angleY = isset($_GET['angley']) ? floatval($_GET['angley']) : null;
    $flat = isset($_GET['flat']) ? intval($_GET['flat']) : null;
    $led = isset($_GET['led']) ? intval($_GET['led']) : null;
    $buzzer = isset($_GET['buzzer']) ? intval($_GET['buzzer']) : null;

    // Validasi input
    if ($angleX !== null && $angleY !== null && 
        $flat !== null && $led !== null && $buzzer !== null) {
        
        // Ambil data terakhir dari database
        $stmt_last = $conn->prepare("SELECT angleX, angleY, posisi_datar, status_led, status_buzzer FROM sensor_keamanan ORDER BY id DESC LIMIT 1");
        $stmt_last->execute();
        $result = $stmt_last->get_result();
        
        $flat_status = $flat ? "Datar" : "Miring";
        $led_status = $led ? "Nyala" : "Mati";
        $buzzer_status = $buzzer ? "Aktif" : "Tidak Aktif";
        
        $save_data = false;
        
        if ($result->num_rows == 0) {
            // Jika tidak ada data sebelumnya, simpan
            $save_data = true;
        } else {
            $last_data = $result->fetch_assoc();
            
            // Periksa apakah ada perubahan
            if ($last_data['posisi_datar'] !== $flat_status || 
                $last_data['status_led'] !== $led_status || 
                $last_data['status_buzzer'] !== $buzzer_status) {
                $save_data = true;
            }
        }
        
        $stmt_last->close();
        
        // Simpan data hanya jika ada perubahan
        if ($save_data) {
            $stmt = $conn->prepare("INSERT INTO sensor_keamanan (angleX, angleY, posisi_datar, status_led, status_buzzer) VALUES (?, ?, ?, ?, ?)");
            
            $stmt->bind_param("ddsss", $angleX, $angleY, $flat_status, $led_status, $buzzer_status);
            if ($stmt->execute()) {
                $message = "Data saved successfully! ID: " . $conn->insert_id;
                echo $message;
                writeLog($message);
            } else {
                $error_message = "Failed to save data. Error: " . $stmt->error;
                echo $error_message;
                writeLog($error_message);
            }
            $stmt->close();
        } else {
            $message = "No changes detected. Data not saved.";
            echo $message;
            writeLog($message);
        }
    } else {
        $invalid_message = "Invalid input data! Received: " . print_r($_GET, true);
        echo $invalid_message;
        writeLog($invalid_message);
    }
} else {
    $method_message = "Invalid request method!";
    echo $method_message;
    writeLog($method_message);
}

$conn->close();
?>