<?php
include("letter_image.php");
include("comment_server.php");
error_reporting(0);
session_start();
$course_id = $_GET['course_id'];
$conn = new mysqli('localhost', 'root', '', 'devtown');
if (!$conn)
    die(mysqli_error($conn));

$reply_flag = 0;
// if(isset($_POST['comment_send'])){
//     if(!empty($_SESSION['User']) && !empty($_POST['comment'])){
//         $content_id = $_SESSION['content_id'];
//         $course_id = $_GET['course_id'];
//         $comment = $_POST['comment'];
//         $sender = $_SESSION['User'];
//         $parent_id = $_POST['parent_id'];
//         $sql = "INSERT INTO `comment`(`parent_id`,`content_id`,`course_id`,`comment`,`sender`,`flag`) VALUES ('$parent_id','$content_id','$course_id','$comment','$sender','0')";
//         mysqli_query($conn,$sql);
//         throw new Exception("this is not work");
//     }
//     echo $_SESSION['content_id'];
// echo $_GET['course_id'];
// echo $_POST['comment'];
// echo $_SESSION['User'];
// echo $_POST['parent_id'];  
// }    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="png" href="Logo/Circle_1980x1980.png" />
    <link rel="stylesheet" href="style.css" />
    <title>DevTown Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .nav-btn {
            position: relative;
            padding-bottom: 5px;
        }

        .nav-btn .line {
            height: 2px;
            position: absolute;
            bottom: 0;
            margin: 10px 0 0 0;
            background: #FF1847;
        }

        .nav-btn ul {
            padding: 0;
            margin: 0;
            list-style: none;
            display: flex;
        }

        .nav-btn ul li {
            margin: 0 40px 0 0;
            opacity: .6;
            transition: all 0.4s ease;
        }

        .nav-btn ul li:hover {
            opacity: .7;
        }

        .nav-btn ul li.active {
            opacity: 1;
        }

        .nav-btn ul li:last-child {
            margin-right: 0;
        }

        .nav-btn ul li a {
            text-decoration: none;
            color: black;
            text-transform: uppercase;
            display: block;
            font-weight: 700;
            letter-spacing: .1em;
        }

        .input-container input[type="text"]:focus~.label,
        .input-container input[type="text"]:valid~.label {
            top: -12px;
            font-size: 16px;
            color: #333;
        }

        .input-container .underline {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            width: 95%;
            background-color: #333;
            transform: scaleX(0);
            transition: all 0.3s ease;
        }

        .input-container input[type="text"]:focus~.underline,
        .input-container input[type="text"]:valid~.underline {
            transform: scaleX(1);
        }
    </style>
</head>

<body class="bg-white scroll-smooth" style="-webkit-tap-highlight-color: transparent; font-family: 'Rubik', sans-serif;" data-aos-easing="ease" data-aos-duration="1200" data-aos-delay="0">
    <div class="overflow-hidden">
        <div class="fixed z-[9999] w-full">
            <!-- Navbar -->
            <nav class="navbar h-16 sm:h-20 backdrop-blur-sm" style="box-shadow: rgba(157, 157, 157, 0.3) 0 4px 10px">
                <ul class="flex justify-between items-center">
                    <li class="flex justify-center items-center">
                        <a href="index.php"><img src="Logo/Circle_1980x1980.png" alt="DevTown" class="w-14 m-1 p-1 sm:w-[74px]" /></a>
                        <p class="text-3xl sm:text-[40px] text-[#30559E]" style="font-family: 'Lobster', cursive;">
                            DevTown
                        </p>
                    </li>
                    <li class="flex justify-center items-center hidden lg:block lg:text-xl xl:text-2xl">About us</li>
                    <li class="flex justify-center items-center hidden md:block md:text-xl xl:text-2xl"><a href="Course.php">Courses</a></li>
                    <li class="flex justify-center items-center hidden lg:block lg:text-xl xl:text-2xl">Contact</li>
                    <li class="flex justify-center items-center hidden md:block md:text-xl xl:text-2xl">Blog</li>
                    <!-- <li class="flex justify-center items-center hidden md:block md:text-xl">Labs <i class="fa-solid fa-angle-down" style="color: #000000;" class></i>
                        <div class="compiler bg-white shadow-lg rounded-2xl ml-10 mt-10" style="display : none;">
                            <ul class="flex flex-col justify-start">
                                <li class="text-sm px-5 pt-5 text-gray-600"><span class="text-xl font-medium text-gray-700 hover:text-black">Programming Compiler</span><br><span>Write and run code in multiple <br>programming language from anywhere.</span></li>
                                <li class="text-sm p-5 text-gray-600"><span class="text-xl font-medium text-gray-700">Web Designing</span><br><span>Write and run code for Web <br>Designing from anywhere.</span></li>
                            </ul>
                        </div>
                    </li> -->
                    <li class="flex justify-center items-center hidden md:block md:text-xl xl:text-2xl"><a href="final_compiler/home.php" class="list-none">Compiler</a></li>
                    <?php
                    if (!$_SESSION['User']) {
                        echo '<li class="flex hidden md:block justify-center items-center mr-3"><a href="login.php"><button class="bg-[#30559E] text-xl sm:text-2xl md:text-xl md:font-medium md:px-5 md:py-1 w-fit px-8 sm:px-10 py-2 text-white rounded-lg flex justify-center items-center shadow-xl">Login<img src="Logo/icons8-login-64.png" alt="Login" width="38px" class="sm:w-[42px]"></button></a></li>';
                    } else {
                        echo '<li class="flex hidden md:block justify-center items-center mr-3"><form method="post"><input type="submit" value="Logout" name="logout" class="bg-[#30559E] cursor-pointer text-xl sm:text-2xl md:text-xl md:font-medium md:px-5 md:py-1 w-fit px-8 sm:px-10 py-2 text-white rounded-lg flex justify-center items-center shadow-xl" /></form></li>';
                    }

                    ?>
                    <!-- <li class="flex hidden md:block justify-center items-center mr-3"><a href="login.php"><button class="bg-[#30559E] text-xl sm:text-2xl md:text-xl md:font-medium md:px-5 md:py-1 w-fit px-8 sm:px-10 py-2 text-white rounded-lg flex justify-center items-center shadow-xl">Login<img src="Logo/icons8-login-64.png" alt="Login" width="38px" class="sm:w-[42px]"></button></a></li> -->
                    <li class="flex justify-center items-center">
                        <input type="hidden" value="0" id="menu_toggle" />
                        <div class="relative flex h-[40px] w-[40px] cursor-pointer flex-col items-end justify-between p-[0.4rem] md:hidden" style="-webkit-tap-highlight-color: transparent" id="menu">
                            <span class="w-10 rounded-md py-[2px] false bg-[#011229] transition-all duration-300" id="first"></span>
                            <span class="w-8 py-[2px] rounded-md bg-[#011229] transition-all duration-300" id="second"></span>
                            <span class="w-6 false rounded-md bg-[#011229] py-[2px] transition-all duration-300" id="third"></span>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="animate__animated animate__fadeIn animate__faster absolute top-full left-0 right-0 z-[9998] backdrop-blur-lg pt-[8vh] pb-[8vh] font-rubik md:hidden  opacity-1 pointer-events-auto visible transition-all duration-300 menu" style="background-color: rgba(255, 255, 255, 0.25); box-shadow: rgba(157, 157, 157, 0.2) 0px 4px 10px; display: none;">
                <ul class="flex flex-col items-center gap-y-6 md:hidden select-none">
                    <li class="text-center text-xl sm:text-2xl"><a href="#">About Us</a></li>
                    <li class="text-center text-xl sm:text-2xl"><a href="Course.php">Courses</a></li>
                    <li class="text-center text-xl sm:text-2xl"><a href="#">Blogs</a></li>
                    <li class="text-center text-xl sm:text-2xl"><a href="#">Programming Compiler</a></li>
                    <li class="text-center text-xl sm:text-2xl"><a href="#">Web Design Compiler</a></li>
                    <li class="text-center text-xl sm:text-2xl"><a href="#">Contact</a></li>
                    <?php
                    if (!$_SESSION['User']) {
                        echo '<li><a href="login.php"><button class="bg-[#30559E] text-xl sm:text-2xl w-fit px-8 sm:px-10 py-2 text-white rounded-lg flex justify-center items-center shadow-lg">Login<img src="Logo/icons8-login-64.png" alt="Login" width="38px" class="sm:w-[42px]"></button></a>
                            </li>';
                    } else {
                        echo '<li class="flex md:block justify-center items-center mr-3"><form method="post"><input type="submit" value="Logout" name="logout" class="bg-[#30559E] cursor-pointer text-xl sm:text-2xl md:text-xl md:font-medium md:px-5 md:py-1 w-fit px-8 sm:px-10 py-2 text-white rounded-lg flex justify-center items-center shadow-xl" /></form></li>';
                    }
                    ?>
                    <!-- <li><a href="login.php"><button class="bg-[#30559E] text-xl sm:text-2xl w-fit px-8 sm:px-10 py-2 text-white rounded-lg flex justify-center items-center shadow-lg">Login<img src="Logo/icons8-login-64.png" alt="Login" width="38px" class="sm:w-[42px]"></button></a>
                    </li> -->
                </ul>
                <div class="mt-6 flex w-full flex-col items-center justify-center gap-x-2 md:hidden">

                </div>
            </div>
        </div>
    </div>
    <!-- Video Section -->
    <div class="mt-20 xl:mt-24">
        <div class="px-2 xl:px-4 lg:px-2 md:px-6 flex flex-col lg:flex-row lg:justify-start justify-start">
            <div class="flex justify-center items-center lg:justify-start lg:items-start">
                <?php
                if (!$_GET['content_id']) {
                    $query = "SELECT * FROM `course_content` WHERE `course_id` = '$course_id' and `type`='Video' and `Flag` = 0 LIMIT 1";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $_SESSION['content_id'] = $row['content_id'];
                ?>
                        <div class="h-[35vh] w-[380px] sm:my-5 sm:mx-2 sm:w-[620px] md:w-[460vh] md:h-[40vh] lg:w-[110vh] lg:h-[60vh] lg:my-3 lg:mx-2 xl:h-[60vh] xl:w-[110vh] xl:my-0 xl:mx-0 2xl:w-[130vh] 2xl:h-[70vh] shadow-lg"><?php echo $row['content']; ?></div>
                    <?php
                    }
                } else {
                    $content_id = $_GET['content_id'];
                    $_SESSION['content_id'] = $_GET['content_id'];
                    $query = "SELECT * FROM `course_content` WHERE `course_id` = '$course_id' and `type`='Video' and `Flag` = 0 and `content_id` = '$content_id'";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="h-[35vh] w-[380px] sm:my-5 sm:mx-2 sm:w-[620px] md:w-[460vh] md:h-[40vh] lg:w-[110vh] lg:h-[60vh] lg:my-3 lg:mx-2 xl:h-[60vh] xl:w-[110vh] xl:my-0 xl:mx-0 2xl:w-[130vh] 2xl:h-[70vh] shadow-lg"><?php echo $row['content']; ?></div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="nav-btn flex justify-center items-center my-5 lg:hidden">
                <ul>
                    <li class="active sm:text-3xl syllabus"><a href="#playlist">Syllabus</a></li>
                    <li class="sm:text-3xl discussion"><a href="#discussion">Discussion</a></li>
                </ul>
            </div>
            <!-- Playlist -->
            <div id="playlist" class="bg-[#DCE1F9] mx-1 mb-5 py-4 px-2 text-lg sm:text-2xl sm:my-2 lg:text-lg lg:h-[61vh] xl:px-4 xl:py-4 flex flex-col xl:w-[27rem] xl:h-[60vh] xl:my-0 xl:mx-4 2xl:h-[70vh] rounded-xl overflow-y-auto ">
                <h1 class="text-gray-900 text-xl sm:text-3xl lg:text-xl font-semibold ml-3">Playlist :</h1>
                <?php
                $sql = "SELECT * FROM `course_content` WHERE `course_id` = '$course_id' and `type`='Video' and `Flag` = 0";
                $record = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_assoc($record)) {
                ?>
                    <a href="tutorial.php?course_id=<?php echo $data['course_id']; ?>&content_id=<?php echo $data['content_id']; ?>" class="py-3 px-3 text-[#30559E] font-medium active:text-gray-900">
                        <h1><?php echo $data['topic_name']; ?></h1>
                    </a>
                    <div class="mb-1 mx-2 bg-[#30559E] h-[1.5px]"></div>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- Discussion -->
        <div id="discussion" class="flex flex-col px-1 py-5 sm:py-7 sm:m-4 md:mt-5 lg:mt-2 lg:py-3 lg:px-2">
            <div class="flex justify-center items-center lg:w-[110vh] lg:bg-transparent rounded-xl mb-4">
                <?php
                letters_images();
                ?>
                <form action="" method="post" id="commentForm" class="flex input-container relative w-full ml-2">
                    <input type="text" id="input_comment" name="enter_comment" required="" class="text-xl sm:text-2xl w-full border-b-2 border-b-gray-300 pt-[14px] bg-transparent outline-none">
                    <label for="input" class="text-xl sm:text-2xl label absolute top-3 left-2 text-gray-400 transition-all duration-300 pointer-events-none">Add a Comment...</label>
                    <div class="underline"></div>
                    <input type="hidden" id="commentId" value="0" name="parent_id">
                    <button class="comment_send" type="submit" id="send" onclick="send_data()"><img src="Logo/send.svg" alt="" class="w-10 ml-1"></button>
                </form>
            </div>
            <script>
                function send_data() {
                    var sender = '<?php echo $_SESSION['User']; ?>';
                    var parent_id = document.getElementsByName(parent_id);
                    var content_id = '<?php echo $_SESSION['content_id']; ?>';
                    var course_id = '<?php echo $_GET['course_id']; ?>';
                    var comment = document.getElementsByName(enter_comment);
                    alert(sender);
                    alert(parent_id);
                    alert(content_id);
                    alert(course_id);
                    alert(comment);
                    jQuery.ajax({
                        url: 'comment_server.php',
                        type: 'post',
                        // dataType: 'json',
                        data: "&sender=" + sender + "&parent_id=" + parent_id + "&content_id=" + content_id + "&course_id=" + course_id + "&comment=" + comment,
                        success: function(response) {
                            if(!response.error()){
                                $('#commentForm')[0].reset();
                            }
                        }
                    });
                }
            </script>
            <?php
            $course_id = $_GET['course_id'];
            $sql = "SELECT * FROM `comment` WHERE `content_id` = '$_SESSION[content_id]' and `course_id` = '$course_id' and `flag` = 0";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $reply_flag = $row['parent_id'];
            ?>
                <div class="flex mt-3">
                    <div class="w-[35px] md:w-[55px] lg:w-[40px] xl:w-[40px] 2xl:w-[40px]"><?php echo all_comment_letters_images($row['sender']); ?></div>
                    <div class="flex flex-col items-start">
                        <h2 class="text-lg ml-3 text-[#30559E] font-medium"><?php echo $row['sender']; ?><span class="text-sm ml-2"><?php echo $row['date']; ?></span></h2>
                        <p class="text-xl ml-3"><?php echo $row['comment']; ?></p>
                        <div>
                            <button class="reply_btn ml-1 mt-3 bg-[#DCE1F9] px-4 py-2 rounded-full font-medium text-[#30559E]" comment-id="<?php echo $row['id']; ?>" id="replyComment">Reply</button>
                            <?php
                            if ($reply_flag > 0) {
                            ?>
                                <button class="ml-5 px-4 py-2 bg-[#DCE1F9] rounded-full hover:bg-[#CBD2F6]"><i class="fa-solid fa-caret-down" style="color: #30559e;"></i> 3 Replies</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        // Hamburger Menu Animate
        $(document).ready(function() {
            $("#menu").click(function() {
                var menu_toggle_click = $("#menu_toggle").val();
                if (menu_toggle_click == 0) {
                    $("#first").removeClass();
                    $("#second").removeClass();
                    $("#third").removeClass();
                    $("#first").addClass(
                        "w-10 rounded-md py-[2px] absolute top-1/2 rotate-45 bg-[#011229] transition-all duration-300"
                    );
                    $("#second").addClass(
                        "w-10 absolute top-1/2 py-0 opacity-0 rounded-md bg-[#011229] transition-all duration-300"
                    );
                    $("#third").addClass(
                        "w-10 absolute top-1/2 -rotate-45 bg-[#011229] rounded-md py-[2px] transition-all duration-300"
                    );
                    menu_toggle_click = $("#menu_toggle").val("1");
                    $(".menu").css('display', 'block');
                } else {
                    $("#first").removeClass();
                    $("#second").removeClass();
                    $("#third").removeClass();
                    $("#first").addClass(
                        "w-10 rounded-md py-[2px] false bg-[#011229] transition-all duration-300"
                    );
                    $("#second").addClass(
                        "w-8 py-[2px] rounded-md bg-[#011229] transition-all duration-300"
                    );
                    $("#third").addClass(
                        "w-6 false rounded-md bg-[#011229] py-[2px] transition-all duration-300"
                    );
                    menu_toggle_click = $("#menu_toggle").val("0");
                    $(".menu").css('display', 'none');
                }
            });
        });

        // nav button
        var nav = $('.nav-btn');
        var line = $('<div />').addClass('line');

        line.appendTo(nav);

        var active = nav.find('.active');
        var pos = 0;
        var wid = 0;

        if (active.length) {
            pos = active.position().left;
            wid = active.width();
            line.css({
                left: pos,
                width: wid
            });
        }

        nav.find('ul li a').click(function(e) {
            e.preventDefault();
            if (!$(this).parent().hasClass('active') && !nav.hasClass('animate')) {

                nav.addClass('animate');

                var _this = $(this);

                nav.find('ul li').removeClass('active');

                var position = _this.parent().position();
                var width = _this.parent().width();

                if (position.left >= pos) {
                    line.animate({
                        width: ((position.left - pos) + width)
                    }, 300, function() {
                        line.animate({
                            width: width,
                            left: position.left
                        }, 150, function() {
                            nav.removeClass('animate');
                        });
                        _this.parent().addClass('active');
                    });
                } else {
                    line.animate({
                        left: position.left,
                        width: ((pos - position.left) + wid)
                    }, 300, function() {
                        line.animate({
                            width: width
                        }, 150, function() {
                            nav.removeClass('animate');
                        });
                        _this.parent().addClass('active');
                    });
                }

                pos = position.left;
                wid = width;
            }
        });
    </script>
    
    <!-- AOS animation -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true
        });
    </script>
</body>