<?php
include_once('module.php');

$comments = query("SELECT * FROM comments ORDER BY created_at DESC");

if (isset($_POST["saveComment"])) {
    if (createComment($_POST) > 0) {
        print_r($_POST);
        echo "
            <script> 
                alert('Pesanmu berhasil disimpan');
                document.location.href='index.php';
            </script>";
    } else {
        echo "
            <script> 
                alert('Pesanmu gagal disimpan, Coba upload ya');
                document.location.href='index.php';
            </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, inscale=1.0">
    <title>Web Undangan Online</title>

    <link rel="icon" type="image/x-icon" href="img/logo-icon/logo-kridzi.jpg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passions+Conflict&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- animation css -->
    <link rel="stylesheet" href="style.css">


    <link rel="stylesheet" href="countdown/simplyCountdown.theme.default.css" />
    <script src="countdown/simplyCountdown.min.js"></script>

</head>

<body class="bg-red-50 overflow-x-hidden" style="font-family: 'Open Sans', sans-serif;">

    <div id="cover" style="background:url(img/bg/wedding1.jpg) center center no-repeat; background-size: cover;" class="kosong z-30 fixed top-0 bottom-0 left-0 right-0 w-full h-screen py-28 px-2">
        <div class="hero">
            <img src="img/element/flower.png" alt="" class="m-auto w-[100px] sm:w-[150px]">
            <h4 class="text-white text-center font-semibold text-[16px] sm:text-[25px]">THE WEDDING OF</h4>
            <h1 class="text-white shaddow-black-2 align-center text-center font-regular text-[60px] sm:text-[80px] md:text-[100px]" style="font-family: 'Passions Conflict', cursive;">Fahmi & Dania</span></h1>
            <hr class="m-auto border-[2px] border-[#fff] w-[16%]">
            <h4 class="text-center shaddow-2 text-white font-semibold  shaddow-black-2">30 Juni 2024</h4>
            <h3 class="text-center text-white font-semibold pt-5 shaddow-black-2 ">Dear, <?= $_GET['to']; ?></h3>
            <button class="btn-open block m-auto py-2 w-[250px] mt-4 text-center text-white bg-red-400 rounded-lg cursor-pointer" id="open"> <i class="ph ph-envelope-simple-open pe-2 fs-4"></i> Buka Undangan </button>
        </div>
    </div>

    <!-- NAVABAR -->

    <nav class="nav fixed bottom-0 w-full px-[6px] h-[70px] bg-white flex items-center justify-center z-20">
        <ul class="flex">
            <li class="rumah m-auto">
                <a href="#home" class="grid">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#475569" class="bi bi-house-heart-fill m-auto" viewBox="0 0 16 16">
                        <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.707L8 2.207 1.354 8.853a.5.5 0 1 1-.708-.707L7.293 1.5Z" />
                        <path d="m14 9.293-6-6-6 6V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9.293Zm-6-.811c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018Z" />
                    </svg>
                    <span class="nav-title font-bold text-slate-600 text-center">Home</span>
                </a>
            </li>
            <li class="pasangan m-auto">
                <a href="#couple" class="grid">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#475569" class="bi bi-heart-fill m-auto" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                    </svg>
                    <span class="nav-title font-bold text-slate-600 text-center">Couple</span>
                </a>
            </li>
            <li class="acara m-auto">
                <a href="#event" class="grid">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#475569" class="bi bi-calendar2-check-fill m-auto" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zm9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5zm-2.6 5.854a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                    </svg>
                    <span class="nav-title font-bold text-slate-600 text-center">Event</span>
                </a>
            </li>
            <li class="galeri m-auto">
                <a href="#gallery" class="grid">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#475569" class="bi bi-image-fill m-auto" viewBox="0 0 16 16">
                        <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                    </svg>
                    <span class="nav-title font-bold text-slate-600 text-center">Gallery</span>
                </a>
            </li>
            <li class="tamu m-auto">
                <a href="#guestbook" class="grid">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#475569" class="bi bi-chat-left-dots-fill m-auto" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>
                    <span class="nav-title font-bold text-slate-600  text-center">Guestbook</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- HOME -->

    <section id="home" style="background:url(img/bg/wedding1.jpg) center center no-repeat; background-size: cover;" class="w-full h-[100%] pt-44 sm:pt-28">
        <div class="hero">
            <img src="img/element/flower.png" alt="" class="m-auto w-[100px] sm:w-[150px]">
            <h4 class="text-white text-center font-semibold text-[16px] sm:text-[25px] shaddow-black-2">The Wedding Of</h4>
            <h1 class="text-white align-center text-center font-regular text-[60px] sm:text-[80px] md:text-[100px] shaddow-black-2" style="font-family: 'Passions Conflict', cursive;">Fahmi & Dania</span></h1>
            <hr class="m-auto border-[2px] border-[#fff] w-[16%]">
            <p class="text-center text-white font-semibold pt-10 shaddow-black-2">30 Juni 2024</p>
        </div>
        <svg class="waves1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(254,242,242,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" class="fill-red-100 opacity-[90%]" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(254,242,242,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" class="fill-red-50" />
            </g>
        </svg>
    </section>

    <!-- COUPLE -->
    <section id="couple" class="couple z-10">
        <div id="couple" class="h-[1800px] sm:h-[900px]">
            <img src="img/element/flower2.png" alt="" class="sm:w-[300px] w-[80%] pt-[50px] flower m-auto">

            <h1 class="title text-[50px] text-center mt-[-5px]" style="font-family: 'Passions Conflict', cursive;">Bridge & Groom</h1>

            <br>

            <div class="opening w-[80%] m-auto">
                <p class="salam italic text-gray-800 text-center text-[16px]">Assalamu’alaikum Warahmatullahi Wabarakatuh</p>

                <br>

                <p class="mt-[10px] text-gray-800 text-center text-[15px]">Maha suci Allah SWT yang telah menciptakan makhluk-Nya berpasang-pasangan.</p>
                <p class="mt-[10px] text-gray-800 text-center text-[15px]">Ya Allah, perkenankanlah kami merangkai kasih sayang yang Kau ciptakan di antara putra-putri kami:</p>
            </div>

            <!-- PROFILES 1 -->
            <div class="profiles flex mt-[70px] invisible sm:visible">
                <div class="profile1 m-auto mr-10">
                    <img src="img/profile/female.jpg" alt="" class="w-[170px] rounded-full border-[4px] border-red-200">
                    <h2 class="mt-[20px] mb-[20px] text-gray-600 text-[70px] text-center" style="font-family: 'Passions Conflict', cursive;">Mynonym</h2>
                    <p class="text-center font-bold text-lg text-stone-800">Dania Restiana Putri</p>
                    <p class="text-center text-sm text-gray-800">Putri Sulung Dari Pasangan
                        <br>
                        <b>Ibu Nurmaningsih & Bapak Yayat Suryana</b>
                    </p>
                </div>
                <div class="profile2 m-auto hidden sm:block">
                    <img src="img/profile/male.jpg" alt="" class="w-[170px] rounded-full border-[4px] border-red-200">
                    <h2 class="mt-[20px] mb-[20px] text-gray-600 text-[70px] text-center" style="font-family: 'Passions Conflict', cursive;">Anonym</h2>
                    <p class="text-center font-bold text-lg text-stone-800">Fahmi Setiansyah</p>
                    <p class="text-center text-sm text-gray-800">Putra Bungsu Dari Pasangan
                        <br>
                        <b>Ibu Dede Karyati & Alm. Bapak Umar</b>
                    </p>
                </div>
            </div>

            <div class="dan m-auto text-center mt-[-375px] font-bold text-[80px] text-stone-800 invisible sm:visible">&</div>

            <!-- PROFILES 2 -->
            <div class="profiles2 grid mt-[-550px] visible sm:invisible">
                <div class="profile-1 m-auto">
                    <img src="img/profile/female.jpg" alt="" class="w-[50%] m-auto rounded-full border-[4px] border-red-200">
                    <h2 class="mt-[20px] mb-[20px] text-gray-600 text-[70px] text-center" style="font-family: 'Passions Conflict', cursive;">Dania Restiana Putri</h2>
                    <!-- <p  class="text-center font-bold text-lg text-stone-800">Dania Restiana Putri</p> -->
                    <p class="text-center text-sm text-gray-800">Putri Sulung Dari Pasangan
                        <br>
                        <b>Ibu Nurmaningsih & Bapak Yayat Suryana</b>
                    </p>
                </div>

                <div class="dan2 m-auto text-center mt-[50px] font-bold text-[80px] text-stone-800 visible sm:invisible">&</div>

                <div class="profile-2 m-auto mt-[50px]">
                    <img src="img/profile/male.jpg" alt="" class="w-[50%] m-auto rounded-full border-[4px] border-red-200">
                    <h2 class="mt-[20px] mb-[20px] text-gray-600 text-[70px] text-center" style="font-family: 'Passions Conflict', cursive;">Fahmi Setiansyah</h2>
                    <!-- <p  class="text-center font-bold text-lg text-stone-800">Fahmi Setiansyah</p> -->
                    <p class="text-center text-sm text-gray-800">Putra Bungsu Dari Pasangan
                        <br>
                        <b>Ibu Dede Karyati & Alm. Bapak Umar</b>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- EVENT -->

    <section id="event" style="background:url(img/bg/wedding1.jpg) center center no-repeat; background-size: cover; filter: contrast(1);" class="w-[100%] h-screen pb-10">

        <div class="kosong2"></div>

        <img src="img/element/flower2.png" alt="" class="sm:w-[300px] w-[80%] pt-[50px] flower2 m-auto">
        <h1 class="title2 text-[50px] text-center mt-[-5px]" style="font-family: 'Passions Conflict', cursive;">Bridge & Groom</h1>

        <div class="acara gap-7 justify-center align-center items-center">
            <div class="card1 bg-red-50 h-[300px] rounded-lg shadow-lg">
                <h2 class="text-[50px] text-center mt-5" style="font-family: 'Passions Conflict', cursive;">Akad Nikah</h2>
                <hr class="border-[2px] border-slate-900 ml-[48%] w-[10%]">
                <div class="schedule flex text-center">
                    <p class="bln text-slate-800 m-auto mt-8 text-center">Juni<br>2024</p>
                    <hr class="line1 mt-8 h-[50px] m-auto border-[1px] border-slate-800">
                    <h4 class="tgl m-auto mt-4"><b class="m-auto flex justify-center text-[35px]">30</b>
                        <p class="text-slate-800 ">Sunday</p>
                    </h4>
                    <hr class="line2 mt-8 h-[50px] m-auto border-[1px] border-slate-800">
                    <p class="tmpt text-slate-800 m-auto mt-8 m-auto text-center">Lapangan <br> PB Damai</p>
                </div>
                <p class="text-slate-800 text-center italic mt-5">09:00 WIB - 12:00 WIB <br>Jl Pasar Dramaga Bogor</p>
            </div>
            <div class="card2 bg-red-50 h-[300px] rounded-lg shadow-lg">
                <h2 class="text-[50px] text-center mt-5" style="font-family: 'Passions Conflict', cursive;">Resepsi</h2>
                <hr class="border-[2px] border-slate-900 ml-[48%] w-[10%]">
                <div class="schedule flex">
                    <p class="bln text-slate-800 m-auto mt-8 text-center">Juni<br>2024</p>
                    <hr class="line1 mt-8 h-[50px] m-auto border-[1px] border-slate-800">
                    <h4 class="tgl m-auto mt-4"><b class="m-auto flex justify-center text-[35px]">30</b>
                        <p class="text-slate-800 ">Sunday</p>
                    </h4>
                    <hr class="line2 mt-8 h-[50px] m-auto border-[1px] border-slate-800">
                    <p class="tmpt text-slate-800 m-auto mt-8 m-auto text-center">Lapangan <br> PB Damai</p>
                </div>
                <p class="text-slate-800 text-center italic mt-5">12:00 WIB - 17:00 WIB <br>Jl Pasar Dramaga Bogor</p>
            </div>
        </div>

        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(254,242,242,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" class="fill-red-100 opacity-[90%]" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(254,242,242,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fef2f2" />
            </g>
        </svg>
    </section>


    <!-- GALLERY -->
    <section id="gallery">
        <div class="photo h-[100%]">
            <img src="img/element/flower2.png" alt="" class="sm:w-[300px] w-[80%] pt-[50px] flower3 m-auto">
            <h1 class="title3 text-[50px] text-center mt-[-5px]" style="font-family: 'Passions Conflict', cursive;">Our Gallery</h1>

            <div class="z-50 full-img w-[100%] h-[100vh] fixed top-0 left-0 items-center justify-center" style="background-color: rgba(255, 255, 255, 0.6); display: none;" id="fullImgBox">
                <img src="img/gallery/img1.jpg" alt="" class="w-[90%] max-w-[500px]" id="fullImg">
                <span class="absolute top-[25%] ml-[85%] text-[30px] cursor-pointer" onclick="closeFullImg()">X</span>
            </div>

            <div class="gallery w-[80%] mt-[100px] m-auto mb-[50px] mt-5 grid md:grid-cols-2 lg:grid-cols-3 gap-[13px]">
                <img src="img/gallery/img1.jpg" alt="" class="w-[100%] rounded-[5px] cursor-pointer  block" onclick="openFullImg(this.src)" id="img1">
                <img src="img/gallery/img4.jpg" alt="" class="w-[100%] rounded-[5px] cursor-pointer  block" onclick="openFullImg(this.src)" id="img4">
                <img src="img/gallery/img2.jpg" alt="" class="w-[100%] rounded-[5px] cursor-pointer h-[300px] block" onclick="openFullImg(this.src)" id="img2">
                <img src="img/gallery/img3.jpg" alt="" class="w-[100%] rounded-[5px] cursor-pointer  block" onclick="openFullImg(this.src)" id="img3">
                <img src="img/gallery/img6.jpg" alt="" class="w-[100%] rounded-[5px] cursor-pointer h-[300px] block" onclick="openFullImg(this.src)" id="img6">
                <img src="img/gallery/img5.jpg" alt="" class="w-[100%] rounded-[5px] cursor-pointer block" onclick="openFullImg(this.src)" id="img5">
            </div>
        </div>

        <div class="h-[100%] pt-10" style="background-image: url(img/bg/wedding1.jpg); background-attachment: fixed; background-size: cover; background-repeat: no-repeat; background-position: 0 -100px;">

            <div class="kosong3"></div>

            <div class="m-auto w-[95%] align-center bg-white/[.7] rounded-[5px] p-2 z-10">
                <p class="text-center text-gray-900 text-[15px] p-6">"Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. Sungguh, pada yang demikian itu benar-benar terdapat tanda-tanda (kebesaran Allah) bagi kaum yang berpikir."</p>
                <h2 class="font-semibold text-center text-[24px] text-slate-900">QS. Ar-Rum : 21</h2>
            </div>

            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(254,242,242,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" class="fill-red-100 opacity-[90%]" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(254,242,242,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fef2f2" />
                </g>
            </svg>
        </div>
        <div class="count-down">

            <img src="img/element/flower2.png" alt="" class="sm:w-[300px] w-[80%] pt-[50px] flower4 m-auto">
            <h1 class="title4 text-[50px] text-center mt-[-5px]" style="font-family: 'Passions Conflict', cursive;">Countdown</h1>


            <div class="simply-countdown"></div>

            <div class="map w-[100%]">
                <div class="maps">
                    <iframe style="border-radius: 25px; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5759718655363!2d106.73749417594028!3d-6.57507556427675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5d291e6e085%3A0x90611ff7cf150c43!2sLapangan%20badminton%20PB%20DAMAI!5e0!3m2!1sid!2sid!4v1716871484935!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="mt-[120px] h-[300px] w-[100%]"></iframe>
                </div>
                <div class="btn-map m-auto">
                    <a href="https://www.google.com/maps/place/Lapangan+badminton+PB+DAMAI/@-6.5750756,106.7374942,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69c5d291e6e085:0x90611ff7cf150c43!8m2!3d-6.5750809!4d106.7400691!16s%2Fg%2F11q9rl4j7l?entry=ttu" target="_blank" class="btn-map text-white m-auto py-2 w-[200px] mt-[40px] flex items-center justify-center rounded-lg bg-[#ff7070] hover:bg-slate-600">Open Google Maps</a>
                </div>
            </div>

        </div>
    </section>

    <!-- GUESTBOOK -->
    <section id="guestbook" class="m-auto h-[900px] mb-5">
        <img src="img/element/flower2.png" alt="" class="sm:w-[300px] w-[80%] pt-[50px] flower5 m-auto">
        <h1 class="title5 text-[50px] text-center mt-[-5px]" style="font-family: 'Passions Conflict', cursive;">GuestBooks</h1>

        <div class="container p-4 ">
            <div class="row g-3">
                <p class="text-center text-grey">Isi form dibawah ini untuk melakukan konfirmasi kehadiran</p>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="col-12 col-md-4 mb-3">
                        <label for="name_user" class="text-grey">Nama :</label>
                        <input type="text" class="form-control" name="name_user" id="name_user" placeholder="Namamu" aria-label="First name">
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label for="status_user" class="text-nowrap text-grey">konfirmasi :</label>
                        <select name="status_user" id="status_user" class="w-100 p-2 rounded border-0 text-grey">
                            <option>Pilih salah satu</option>
                            <option value="Tidak Hadir">Tidak hadir</option>
                            <option value="Hadir">Hadir</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label for="comment" class="text-nowrap text-grey">Pesan : </label>
                        <textarea class="form-control" name="comment" id="comment" placeholder="Pesan untuk mempelai" width="100%"></textarea>
                    </div>
                    <div class="col-5 mt-3">
                        <button type="submit" id="saveComment" name="saveComment" class="btn btn-light">Kirim</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="book m-auto bg-white w-[95%] sm:w-[75%] md:w-[70%] lg:w-[50%] xl:w-[47%] h-[58%] rounded-2xl border-[1.5px] border-red-400 overflow-auto">
            <?php foreach ($comments as $comment) : ?>
                <?php
                $words = explode(" ", $comment['name_user']);
                $acronym = "";
                foreach ($words as $w) {
                    $acronym .= mb_substr($w, 0, 1);
                }
                ?>
                <div class="flex ml-[30px] mt-[40px]">
                    <div class="text-uppercase profile bg-[#ff7070] w-[50px] h-[50px] text-white flex items-center justify-center rounded-full text-[25px]"><?= $acronym; ?></div>
                    <h4 class="ml-[15px] mt-[-2px] text-gray-600 font-semibold"><?= $comment['name_user'] ?> - <div class="badge badge-xs rounded-pill bg-primary"> <?= $comment['status_user'] ?> </div><br>
                        <p class="text-[11px]"><?= date('j F Y H:i', strtotime($comment['created_at'])) ?></p>
                    </h4>
                </div>
                <p class="px-10 m-auto pt-5 text-[14px] md:text-[15px] lg:text-[16px]"><?= $comment['comment'] ?></p>
                <hr class="m-auto mt-4 border-[#ff7070] w-[95%]">
            <?php endforeach; ?>
        </div>
    </section>

    <!-- WEDDING GIFT -->
    <section id="wedding-gift" class="mt-[250px] h-[800px] mb-5">
        <div class="container mt-5 mb-5">
            <div class="text-center mb-4">
                <h1 class="title5 text-[50px] text-center mt-[-5px]" style="font-family: 'Passions Conflict', cursive;">Wedding Gift</h1>
                <p>Restu dan doa dari Anda adalah anugerah yang sangat berarti bagi kami. Namun, jika memberi adalah ungkapan kasih sayang Anda, Anda dapat memberikannya secara elektronik.</p>
            </div>

            <div class="gift-card">
                <div class="card-gift-header d-flex align-items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/SeaBank.svg/2560px-SeaBank.svg.png" alt="Card Icon" class="icon-gift mr-3">
                    <div>
                        <div class="bank-name">SEA BANK INDONESIA</div>
                        <div class="card-holder">krit</div>
                        <div class="card-number">000</div>
                        <button class="btn btn-outline-primary btn-copy" onclick="copyText('000')">Salin</button>
                    </div>
                </div>
            </div>

            <div class="gift-card">
                <div class="card-gift-header d-flex align-items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c0/Logo-jago.svg/2560px-Logo-jago.svg.png" alt="Card icon-gift" class="icon-gift mr-3">
                    <div>
                        <div class="bank-name">BANK Jago</div>
                        <div class="card-holder">krit</div>
                        <div class="card-number">000</div>
                        <button class="btn btn-outline-primary btn-copy" onclick="copyText('000')">Salin</button>
                    </div>
                </div>
            </div>

            <div class="gift-card">
                <div class="card-gift-header d-flex align-items-center">
                    <img src="img/element/home.png" alt="Card icon-gift" class="icon-gift mr-3">
                    <div>
                        <div class="bank-name">KADO</div>
                        <div class="card-holder">krit</div>
                        <div class="card-number">bogor</div>
                        <button class="btn btn-outline-primary btn-copy" onclick="copyText('bogor')">Salin</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#faebd7] w-full h-[100px] relative bottom-0 mb-5">
        <div class="footer pt-[25px]">
            <div class="flex justify-center">
                <img src="img/logo-icon/logo-ocumps.png" alt="" class="rounded-full w-[20px] h-[20px]">
            </div>
            <p class="m-auto text-center mt-2 text-xs">Ⓒ <a href="https://kitakad.ocumps.tech">Powered By Kita Akad</a> </p>
        </div>
    </footer>

    <div class="audio-player fixed bottom-[70px] sm:bottom-[90px] right-[-160px] sm:right-[-150px] z-20">
        <audio autoplay loop src="mp3/Ed-Sheeran-Perfect.mp3"></audio>
        <div class="controls m-auto">
            <button class="player-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#3D3132">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    <script src="query-3.6.1.min.js"></script>
    <script src="script.js"></script>
    <script>
        function copyText(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Copied to clipboard');
            }, function() {
                alert('Failed to copy text');
            });
        }
        simplyCountdown(".simply-countdown", {
            year: 2024, // required
            month: 6, // required
            day: 30, // required
            hours: 12, // Default is 0 [0-23] integer
            minutes: 0, // Default is 0 [0-59] integer
            seconds: 0, // Default is 0 [0-59] integer
            words: {
                //words displayed into the countdown
                days: {
                    singular: "hari",
                    plural: "hari"
                },
                hours: {
                    singular: "jam",
                    plural: "jam"
                },
                minutes: {
                    singular: "menit",
                    plural: "menit"
                },
                seconds: {
                    singular: "detik",
                    plural: "detik"
                },
            },
        });
    </script>
</body>

</html>