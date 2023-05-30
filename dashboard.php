<?php
session_start();
require_once 'include/head.php';
require_once 'database/db_connection.php';

$userQuery = "SELECT * FROM users WHERE user_id = '{$_SESSION['user_id']}'";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);

if ($user) {
    // User data is available, proceed with displaying the dashboard

    // Fetch upcoming events
    $eventsQuery = "SELECT * FROM events WHERE date >= CURDATE() ORDER BY date LIMIT 3";
    $eventsResult = mysqli_query($conn, $eventsQuery);

    // Fetch next scheduled meeting and agenda
    $meetingQuery = "SELECT * FROM meetings WHERE date >= CURDATE() ORDER BY date LIMIT 1";
    $meetingResult = mysqli_query($conn, $meetingQuery);
    $meeting = mysqli_fetch_assoc($meetingResult);

    // Generate random investment quote
    $quotes = [
        "The stock market is filled with individuals who know the price of everything, but the value of nothing." => "Philip Fisher",
        "The investor's chief problem—and even his worst enemy—is likely to be himself." => "Benjamin Graham",
        "In the short run, the market is a voting machine, but in the long run, it is a weighing machine." => "Benjamin Graham",
        "Price is what you pay. Value is what you get." => "Warren Buffett",
        "Investing should be more like watching paint dry or watching grass grow. If you want excitement, take $800 and go to Las Vegas." => "Paul Samuelson",
        "The four most dangerous words in investing are: 'This time it's different'." => "Sir John Templeton",
        "The stock market is like a yo-yo on an escalator. It's a constant contradiction." => "Warren Buffett",
        "The four most dangerous words in investing are: 'This time it's different'." => "Sir John Templeton",
        "The only way to do great work is to love what you do." => "Steve Jobs",
        "Believe you can and you're halfway there." => "Theodore Roosevelt",
        "In the middle of every difficulty lies opportunity." => "Albert Einstein",
        "Don't watch the clock; do what it does. Keep going." => "Sam Levenson",
        "The future belongs to those who believe in the beauty of their dreams." => "Eleanor Roosevelt",
        "The only limit to our realization of tomorrow will be our doubts of today." => "Franklin D. Roosevelt",
        "Success is not final, failure is not fatal: It is the courage to continue that counts." => "Winston Churchill",
        "The only thing standing between you and your goal is the story you keep telling yourself." => "Jordan Belfort",
        "The best time to plant a tree was 20 years ago. The second best time is now." => "Chinese Proverb",
        "The future depends on what you do today." => "Mahatma Gandhi",
        "You are never too old to set another goal or to dream a new dream." => "C.S. Lewis",
        "Don't be pushed around by the fears in your mind. Be led by the dreams in your heart." => "Roy T. Bennett",
        "Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful." => "Albert Schweitzer",
        "The only limit to our realization of tomorrow will be our doubts of today." => "Franklin D. Roosevelt",
        "Believe you can and you're halfway there." => "Theodore Roosevelt",
        "In the middle of every difficulty lies opportunity." => "Albert Einstein",
        "Don't watch the clock; do what it does. Keep going." => "Sam Levenson",
        "The future belongs to those who believe in the beauty of their dreams." => "Eleanor Roosevelt",
        "The only thing standing between you and your goal is the story you keep telling yourself." => "Jordan Belfort",
        "The best time to plant a tree was 20 years ago. The second best time is now." => "Chinese Proverb",
            ];
    $randomQuote = array_rand($quotes);
    $quote = $randomQuote;
    $author = $quotes[$randomQuote];

    $verses = [
        "Trust in the Lord with all your heart and lean not on your own understanding." => "Proverbs 3:5",
        "For I know the plans I have for you... plans to give you hope and a future." => "Jeremiah 29:11",
        "The Lord is my shepherd, I lack nothing." => "Psalm 23:1",
        "Be strong and courageous... for the Lord your God will be with you wherever you go." => "Joshua 1:9",
        "I can do all this through him who gives me strength." => "Philippians 4:13",
        "Cast all your anxiety on him because he cares for you." => "1 Peter 5:7",
        "Be kind and compassionate to one another, forgiving each other, just as in Christ God forgave you." => "Ephesians 4:32",
        "Do not be anxious about anything, but in every situation, by prayer and petition, present your requests to God." => "Philippians 4:6",
        "And we know that in all things God works for the good of those who love him." => "Romans 8:28",
        "The Lord is my light and my salvation—whom shall I fear?" => "Psalm 27:1",
        "Give thanks to the Lord, for he is good; his love endures forever." => "Psalm 107:1",
        "Do not conform to the pattern of this world, but be transformed by the renewing of your mind." => "Romans 12:2",
        "Be still, and know that I am God; I will be exalted among the nations." => "Psalm 46:10",
        "But seek first his kingdom and his righteousness, and all these things will be given to you as well." => "Matthew 6:33",
        "The Lord bless you and keep you; the Lord make his face shine on you and be gracious to you." => "Numbers 6:24-26",
        "But those who hope in the Lord will renew their strength; they will soar on wings like eagles." => "Isaiah 40:31",
        "Rejoice always, pray continually, give thanks in all circumstances." => "1 Thessalonians 5:16-18",
        "Be completely humble and gentle; be patient, bearing with one another in love." => "Ephesians 4:2",
        "I have told you these things, so that in me you may have peace. In this world you will have trouble. But take heart! I have overcome the world." => "John 16:33",
        "Finally, brothers and sisters, whatever is true, whatever is noble, whatever is right, whatever is pure, whatever is lovely, whatever is admirable—think about such things." => "Philippians 4:8",

    ];
    
    $bibleVerse = array_rand($verses);
    $verse = $bibleVerse;
    $book = $verses[$bibleVerse];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'include/head.php'; ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">

    <style>
        /* Custom styling */
        body {
            background-color: #f8f9fa;
        }

        .container {
            padding-top: 50px;
        }

        .small-box {
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            color: #fff;
        }

        .small-box .inner {
            padding: 10px;
        }

        .small-box h3 {
            font-size: 30px;
            font-weight: bold;
            margin: 0;
        }

        .small-box p {
            font-size: 18px;
            margin: 0;
        }

        .small-box .icon {
            font-size: 70px;
        }

        .small-box .small-box-footer {
            font-size: 16px;
        }

        h1 {
            color: #343a40;
            margin-bottom: 30px;
        }

        h2 {
            color: #343a40;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .list-group-item {
            background-color: #f8f9fa;
            border: none;
            border-bottom: 1px solid #ddd;
            color: #343a40;
            font-size: 16px;
        }

        .card-text {
            color: #6c757d;
            margin-top: 10px;
        }

        .blockquote-footer {
            color: #6c757d;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php require_once 'include/navbar.php'; ?>

    <div class="container mt-4">
        <h1>Welcome, <?php echo $user['username']; ?></h1>

        <div class="small-box bg-info">
            <div class="inner">
            <h2>Total Contribution</h2>
            <?php
            // Fetch the total contribution for the logged-in user
            $user_id = $_SESSION['user_id'];
            $query = "SELECT SUM(contribution) AS totalContribution FROM users WHERE user_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $totalContribution = $row['totalContribution'];
                echo '<h3>Ksh. ' . $totalContribution . '</h3>';
            } else {
                echo 'Error retrieving total contribution.';
            }
            ?>
        </div>

        <div class="card">
            <h2>Upcoming Events</h2>
            <ul class="list-group">
                <?php while ($event = mysqli_fetch_assoc($eventsResult)) { ?>
                    <li class="list-group-item">
                        <?php if (isset($event['event_name'])) {
                            echo $event['event_name'] . ' - ' . $event['date'] . ' - ' . $event['description'];
                        } else {
                            echo 'Unknown Event - ' . $event['date'];
                        } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <div class="card">
            <h2>Next Scheduled Meeting</h2>
            <?php if ($meeting) { ?>
                <div class="card-body">
                    <h5 class="card-title">Date: <?php echo $meeting['date']; ?></h5>
                    <h6 class="card-text">Meeting Name: <?php echo $meeting['meeting_name']; ?></h6>
                    <p class="card-text">Agenda: <?php echo $meeting['description']; ?></p>
                </div>
            <?php } else { ?>
                <p>No upcoming meetings.</p>
            <?php } ?>
        </div>

        <div class="card">
            <h2>Daily Motivation</h2>
            <blockquote class="blockquote">
                <p class="card-text"><?php echo $quote; ?></p>
                <footer class="blockquote-footer"><?php echo $author; ?></footer>
            </blockquote>
        </div>

        <div class="card">
            <h2>Word Of The Day</h2>
            <blockquote class="blockquote">
                <p class="card-text"><?php echo $verse; ?></p>
                <footer class="blockquote-footer"><?php echo $book; ?></footer>
            </blockquote>
        </div>
    </div>

    <?php require_once 'include/footer.php'; ?>
</body>

</html>
