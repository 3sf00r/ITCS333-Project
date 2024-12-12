
<?php
session_start();
include '../includes/header.php';
include '../includes/db_connect.php';

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];

$error = "";

$department_id = $_POST['department_id'] ?? null;
$list_all = isset($_POST['list_all']) ? 1 : 0;
$type = $_POST['type'] ?? null;
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['filter'])) {
        if (empty($department_id) && empty($type) && $list_all == 0) {
            $error .= "Please select a department, room type, or check 'List All Rooms'.<br>";
        } else {}
    } else {
        $sql = "SELECT * FROM rooms";
        $params = [];
            if ($department_id !== null && $department_id != '') {
                $sql .= " WHERE department_id = :department_id";
                $params[':department_id'] = $department_id;
            }
            if ($type !== null && $type != '') {
                $sql .= " AND type = :type";
                $params[':type'] = $type;
            }
            if ($list_all == 0) {
                $sql .= " LIMIT 1";
            }
        $rooms = [];
      
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($rooms)) {
            $error .= "No rooms found with the selected filters.<br>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {
    $room_id = $_POST['room_id'];
    $start_date = $_POST['start_date'];
    $start_time = $_POST['start_time'];

    if (isset($_POST['duration'])) {
        switch ($_POST['duration']) {
            case '1 hour 40 minutes':
                $end_time = date('Y-m-d H:i:s', strtotime('+100 minutes', strtotime($start_date . ' ' . $start_time)));
                break;
            case '1 hour 15 minutes':
                $end_time = date('Y-m-d H:i:s', strtotime('+75 minutes', strtotime($start_date . ' ' . $start_time)));
                break;
            case '50 minutes':
                $end_time = date('Y-m-d H:i:s', strtotime('+50 minutes', strtotime($start_date . ' ' . $start_time)));
                break;
            default:
                $error .= 'Invalid duration selected.<br>';
        }
    }

    // Validate inputs
    if (empty($room_id)) {
        $error .= "Please select a room.<br>";
    }
    if (empty($start_date) || empty($start_time)) {
        $error .= "Please enter the start date and time.<br>";
    }
    $combinedDateTime = $start_date . ' ' . $start_time;

    
  //overlapping or conflict bookings check
  $stm0 = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE status ='booked' AND room_id = :room_id AND ((start_time <= :end_time AND end_time >= :start_time) OR (start_time < :end_time AND end_time > :start_time))");
  $stm0->bindParam(':room_id', $room_id);
  $stm0->bindParam(':start_time', $combinedDateTime);
  $stm0->bindParam(':end_time', $end_time);
  $stm0->execute();
  if ($stm0->fetchColumn() > 0) {
      $error .= "The selected time slot is already booked. Please choose another time.<br>";
  }
    // insert booking to database
    if (empty($error)) {
        $stmt = $pdo->prepare("INSERT INTO bookings (`user_id`, `user_email`, `room_id`, `start_time`, `end_time`) VALUES (:user_id, :user_email, :room_id, :start_time, :end_time)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':start_time', $combinedDateTime);
        $stmt->bindParam(':end_time', $end_time);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Booking successful!</div>";
        } else {
            $error .= "Error saving booking.<br>";
        }
    }
//debug
    if (!empty($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
?>

<div class="main2">
    <h2>Room Filter</h2>
    <form name="filterform" id="filterForm" action="" method="post">
        <div class="form-group">
            <label for="department_id">Select Department:</label>
            <select name="department_id" id="department_id" class="select" onchange="toggletype()">
                <option value="">-- Select a department --</option>
                <?php
                $stmt = $pdo->query("SELECT * FROM departments");
                $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($departments as $department): ?>
                    <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="type" id="type">Select Room Type:</label>
            <select name="type" id="type" class="select">
                <option value="">-- Select a room type --</option>
                <?php
                $stmt = $pdo->query("SELECT DISTINCT type FROM rooms");
                $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($roomTypes as $roomType): ?>
                    <option value="<?php echo $roomType['type']; ?>"><?php echo $roomType['type']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="list_all">List All Rooms:</label>
            <input type="checkbox" name="list_all" id="list_all">
        </div>

        <button type="submit" name="filter" class="glass-btn">Filter</button>
    </form>
</div>

<?php if (!empty($rooms)): ?>
    <div class="container">
        <h2>Available Rooms</h2>
        <?php foreach ($rooms as $room): ?>
            <div class="main">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($room['name']); ?></h5>
                    <p class="card-text">Room Type: <?php echo htmlspecialchars($room['type']); ?></p>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="select2" required>

            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" id="start_time" class="select2" required>
            
        </div>

        
        <div class="form-group">
            <label>Select Duration:</label>
            <select name="duration" id="duration" class="select" required>
                <option value="">Select</option>
                <option value="1 hour 40 minutes">1 hour 40 minutes</option>
                <option value="1 hour 15 minutes">1 hour 15 minutes</option>
                <option value="50 minutes">50 minutes</option>
            </select>
        </div><input type="submit" name="book" class="glass-btn" value="Book Now">
                    </form>
                </div>
            </div>
            

        <?php endforeach; ?>
    </div>
<?php endif; ?>
<script>
function toggletype() {
    var select = document.getElementById('department_id');
    var typeDiv = document.getElementById('type'); 
    var type = document.getElementById('type');

    if (select.value === '') { 
        typeDiv.style.display = 'none';
        type.style.display = 'none'; // Hide when no department is selected
    } else {
        typeDiv.style.display = 'block';
        type.style.display = 'block'; // Show when department is selected
    }
}

toggletype();
</script>
<?php include '../includes/footer.php'; ?>

