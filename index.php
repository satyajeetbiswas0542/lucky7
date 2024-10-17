<?php
session_start();
if(!isset($_SESSION['money']) || !empty($_REQUEST['restart']))
    $_SESSION['money'] = 100;

$dice1 = rand(1, 6);
$dice2 = rand(1, 6);
$sum = $dice1 + $dice2;

if(!empty($_REQUEST['option']) && $_SESSION['money'] > 0) {
    $option = $_REQUEST['option'];
    $_SESSION['money'] -= 10;
    if($option == 'Below 7' && $sum < 7) {
        $_SESSION['money'] += 20;
        $result = true;
        $message = 'You won 20';
    }
    else if($option == 'Above 7' && $sum > 7) {
        $_SESSION['money'] += 20;
        $result = true;
        $message = 'You won 20';
    }
    else if($option == '7' && $sum == 7) {
        $_SESSION['money'] += 30;
        $result = true;
        $message = 'You won 30';
    }
    else {
        $result = false;
        $message = 'You lost';
    }
}
?>
<p>Welcome to Lucy 7 game</p>
<form method="post">
    <p>Place your bet (Rs 10):</p>
    <?php if($_SESSION['money'] > 0) { ?>
    <input type="submit" name="option" value="Below 7">
    <input type="submit" name="option" value="7">
    <input type="submit" name="option" value="Above 7">
    <br>
    <?php } else { ?>
    <p>You lost all money. Restart the game.</p>
    
    <?php } ?>
    <input type="submit" name="restart" value="Restart Game">
</form>

<?php if(!empty($_REQUEST['option'])) { ?>
<p>Game Results:</p>
<p>Dice 1: <?php echo $dice1; ?></p>
<p>Dice 2: <?php echo $dice2; ?></p>
<p>Total: <?php echo $sum; ?></p>
<?php
if($result)
    echo '<p>Congratulations! You won. Your balance is now Rs. ' . $_SESSION['money'] . '.</p>';
else
    echo '<p>Sorry! You lost. Your balance is now Rs. ' . $_SESSION['money'] . '.</p>'
?>
<?php } else {
    echo '<p>Your balance is Rs. ' . $_SESSION['money'] . '.</p>';
} ?>
