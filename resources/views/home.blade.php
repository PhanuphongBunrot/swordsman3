@extends('layouts.app')
@section('title', 'หน้าแรก')

@section('content')
<!-- เลื่อนsmooth -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script> -->


<style>
.carousel-container{
    padding:0px;
}
.carousel-inner {
    display: flex;
    align-items: center;
    background-color: black;
}


.carousel-item {
    text-align: center;
    height: 50vh; 
    display: flex;
    justify-content: center;
    align-items: center;
    background:transparent;
}


.carousel-image {
    max-height: 100vh; 
    width: 100%;
    object-fit: contain;
   
}


.carousel-caption {
    background: rgba(0, 0, 0, 0.6);
    padding: 10px;
    border-radius: 10px;
    transition: opacity 0.5s ease-in-out;
}


    /*game card*/
    .game-card {
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        transform-style: preserve-3d;
        will-change: transform;
        perspective: 1000px;
    }

    
    .game-card:hover {
        transform: scale(1.05) rotateX(5deg) rotateY(-5deg);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    }

 
    /* .game-card.border-c {
        border: 5px solid #41e0cf;
    }

  
    .game-card.selected .card-title {
        color: #41e0cf;
    } */

    @keyframes borderAnimation {
        0% { border-image-source: linear-gradient(45deg, #41e0cf, #ffcc00, #ff5e62); }
        25% { border-image-source: linear-gradient(90deg, #ffcc00, #ff5e62, #41e0cf); }
        50% { border-image-source: linear-gradient(135deg, #ff5e62, #41e0cf, #ffcc00); }
        75% { border-image-source: linear-gradient(180deg, #41e0cf, #ff5e62, #ffcc00); }
        100% { border-image-source: linear-gradient(225deg, #ffcc00, #41e0cf, #ff5e62); }
    }

    /* @keyframes textGlow {
        0% { text-shadow: 0 0 5px #41e0cf, 0 0 10px #41e0cf; }
        25% { text-shadow: 0 0 5px #ffcc00, 0 0 10px #ffcc00; }
        50% { text-shadow: 0 0 5px #ff5e62, 0 0 10px #ff5e62; }
        75% { text-shadow: 0 0 5px #41e0cf, 0 0 10px #41e0cf; }
        100% { text-shadow: 0 0 5px #ffcc00, 0 0 10px #ffcc00; }
    } */

    .game-card.border-c {
        border: 2.5px solid transparent;
        
        border-image-slice: 1;
         animation: borderAnimation 4s infinite alternate linear;
    }

    .game-card.selected .card-title {
        color: black; 
        /* animation: textGlow 2s infinite alternate; */
    }
    .game-card.selected{
        scale:1.05;
    }

  


    #game-cards .card {
        margin: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
    }

 
    #game-cards .card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }


    #game-cards .card:hover img {
        transform: scale(1.05);
    }

 
    .game-card::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 10%, transparent 70%);
        transition: opacity 0.3s ease;
        opacity: 0;
        pointer-events: none;
    }

    
    .game-card:hover::before {
        opacity: 1;
    }
    




    .section-header {
        /* background-color: #40E0D0; */
        /* padding: 5px; */
        border-radius: 5px;
        color: #000000;
      
        /* margin-bottom: 5px; */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* ปุ่มถัดไปและย้อนกลับ */
    /* ปุ่มถัดไปและย้อนกลับ */
    .pagination-buttons {
        display: flex;
        gap: 10px;
    }

    .pagination-buttons button {
        color: #41e0cf;
        border: 2px solid #41e0cf;
        /* กรอบสีน้ำเงิน */
        border-radius: 50%;
        /* ทำให้ปุ่มเป็นวงกลม */
        width: 50px;
        /* กำหนดความกว้าง */
        height: 50px;
        /* กำหนดความสูง */
        padding: 0;
        /* ลบการ padding ในปุ่ม */
        cursor: pointer;
        background-color: transparent;
        /* พื้นหลังใส */
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s, color 0.3s;
    }

    .pagination-buttons button:hover {
        background-color: #41e0cf;
        /* เปลี่ยนพื้นหลังเป็นสีม่วงเมื่อเม้าชี้ */
        color: white;
        /* เปลี่ยนสีตัวอักษรเป็นขาว */
    }

    .pagination-buttons button:active {
        background-color: #41e0cf;
        color: white;
        /* เปลี่ยนเป็นสีม่วงเข้มเมื่อคลิก */
    }

    h4 {
        color: #41e0cf;
    }

    .btn-icon {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        border: 2px solid transparent;
        border-radius: 5px;
        color: white;
        background-color: black;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn-icon i {
        margin-right: 8px;
    }

    .btn-icon:hover {
        border-color: lightgreen;
        box-shadow: 0 0 10px rgba(144, 238, 144, 0.7);
        color: #41e0cf;
    }


    
    @media (max-width: 767px) {
        
      .carousel-item {
        text-align: center;
        height: 100%; 
        display: flex;
        justify-content: center;
        align-items: center;
        }
        .carousel-image {
        max-height: 100vh; 
        width: 100%;
        object-fit: cover;
    
        }

        
        .selectgame-container h4{
            display:flex;
            font-size:12px;
            text-align:center;
            align-items:center;
        }

        .pagination-buttons button {
       
        color: #41e0cf;
        border: 2px solid #41e0cf;
        /* กรอบสีน้ำเงิน */
        border-radius: 50%;
        /* ทำให้ปุ่มเป็นวงกลม */
        width: 30px;
        /* กำหนดความกว้าง */
        height: 30px;
        /* กำหนดความสูง */
        padding: 0;
        margin:0;
        /* ลบการ padding ในปุ่ม */
        cursor: pointer;
        background-color: transparent;
        /* พื้นหลังใส */
  
        }



    /*game card */
         #game-cards .col-md-3 {
         flex: 0 0 50%; 
         max-width: 50%;
            
        }
        .card h5{
           font-size:10px;
        }
        .card-body{
           padding-top:10px;
           padding-left: 2px;
           padding-right: 2px;
           padding-bottom: 2px;
        }

        /*แถบแพ็คเกจ */
        .package-container {
            display: flex;
            flex-wrap: wrap; 
            justify-content: center; 
            gap: 15px; 
            padding:0px 5px ;
            height:auto;
        }

       .btn-icon p {
            white-space: nowrap; 
            font-size: 12px; 
            text-align: center;
            margin: 0;
        }

        .btn-icon {
        display: flex;
        flex-direction: column; 
        align-items: center;
        justify-content: center;
        width: 80px; 
        height: 50px;
        padding: 0px 5px;
        text-align: center;
        margin: 0;
         }

      

        


    }
    
    @media only screen and (min-width: 768px) and (max-width: 1400px)  {
        .carousel-item {
        text-align: center;
        background:transparent;
         height: 100%; 
        display: flex;
        justify-content: center;
        align-items: center;
      
        }

        .card h5{
           font-size:13px;
        }
      
    } 

</style>

<div class="carousel-container">
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="hover">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/01.jpg') }}" class="carousel-image" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First Slide</h5>
                    <p>รายละเอียดเกี่ยวกับสไลด์แรก</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/02.jpg') }}" class="carousel-image" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second Slide</h5>
                    <p>รายละเอียดเกี่ยวกับสไลด์ที่สอง</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/03.jpg') }}" class="carousel-image" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third Slide</h5>
                    <p>รายละเอียดเกี่ยวกับสไลด์ที่สาม</p>
                </div>
            </div>
        </div>

        <!-- ปุ่มเลื่อนซ้ายขวา -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</div>

<div class="selectgame-container mt-4">
    <div class="section-header p-1" style="background-color:rgb(0, 0, 0);">
        <h4>เลือกเกม</h4>
        <div class="pagination-buttons">
            <div class="pagination-buttons">
                <button id="prevBtn" onclick="navigateCards('prev')">
                    <<
                        </button>
                        <button id="nextBtn" onclick="navigateCards('next')">
                            >>
                        </button>
            </div>

        </div>
    </div>
    <div class="row" id="game-cards">
        <!-- การ์ดจะถูกเพิ่มที่นี่โดย JavaScript -->
    </div>
</div>



<div class="package-container mt-4 mb-4">
    <div class="d-flex p-2" style="background-color:rgb(0, 0, 0); gap: 10px;">
        <button class="btn btn-icon">
            <p style="color:#41e0cf; margin: 0;"> <i class="bi bi-gem"></i> หยก</p>
        </button>
        <button class="btn btn-icon">
            <p style="color:#41e0cf; margin: 0;"> <i class="bi bi-gem"></i> ทอง</p>
        </button>
        <button class="btn btn-icon">
            <p style="color:#41e0cf; margin: 0;"> <i class="bi bi-gem"></i> ตำลึง</p>
        </button>
        <button class="btn btn-icon">
            <p style="color:#41e0cf; margin: 0;"> <i class="bi bi-gift"></i> โปรโมชั่น</p>
        </button>
    </div>

</div>



<script>
    const games = [{
            name: "Swordsman3",
            img: "{{ asset('images/Logo Sword Man 3 Final.jpg') }}"
        },
        {
            name: "เกม B",
            img: "{{ asset('images/Logo Sword Man 3 Final.jpg') }}"
        },
        {
            name: "เกม C",
            img: "{{ asset('images/Logo Sword Man 3 Final.jpg') }}"
        },
        {
            name: "เกม D",
            img: "{{ asset('images/Logo Sword Man 3 Final.jpg') }}"
        },
        {
            name: "เกม E",
            img: "{{ asset('images/Logo Sword Man 3 Final.jpg') }}"
        },
        {
            name: "เกม F",
            img: "{{ asset('images/Logo Sword Man 3 Final.jpg') }}"
        },
        {
            name: "เกม G",
            img: "{{ asset('images/Logo Sword Man 3 Final.jpg') }}"
        },
        {
            name: "เกม H",
            img: "{{ asset('images/Logo Sword Man 3 Final.jpg') }}"
        },
    ];

    
    // function renderCards() {
        //     const startIdx = currentPage * cardsPerPage;
        //     const endIdx = startIdx + cardsPerPage;
        //     const pageGames = games.slice(startIdx, endIdx);
        
        //     const gameCardsContainer = document.getElementById('game-cards');
        //     gameCardsContainer.innerHTML = '';
        //     pageGames.forEach(game => {
            //         const card = document.createElement('div');
            //         card.classList.add('col-md-3');
            //         card.innerHTML = `
            //         <div class="card game-card" data-game-name="${game.name}">
            //             <img src="${game.img}" class="card-img-top" alt="${game.name}" onerror="this.onerror=null; this.src='path/to/default-image.jpg';">
            //             <div class="card-body text-center">
            //                 <h5 class="card-title">${game.name}</h5>
            //             </div>
            //         </div>
            //     `;
            //         gameCardsContainer.appendChild(card);
            //     });
            // }
            
    const cardsPerPage = 4;
    let currentPage = 0;

    function navigateCards(direction) {
        if (direction === 'next') {
            // เลื่อนไปข้างหน้า ถ้าถึงหน้าสุดท้ายจะวนกลับไปที่หน้าแรก
            currentPage = (currentPage + 1) % Math.ceil(games.length / cardsPerPage);
            
        } else if (direction === 'prev') {
            // เลื่อนไปข้างหลัง ถ้าถึงหน้าแรกจะวนกลับไปที่หน้าสุดท้าย
            currentPage = (currentPage - 1 + Math.ceil(games.length / cardsPerPage)) % Math.ceil(games.length / cardsPerPage);
        }
        renderCards();
    }

    // เริ่มต้นแสดงการ์ด
    document.addEventListener('DOMContentLoaded', function() {
        // เรียกใช้งาน renderCards เมื่อหน้าโหลดเสร็จ
        renderCards();
    });

    

    function renderCards() {
        const startIdx = currentPage * cardsPerPage;
        const endIdx = startIdx + cardsPerPage;
        const pageGames = games.slice(startIdx, endIdx);

        const gameCardsContainer = document.getElementById('game-cards');
        gameCardsContainer.innerHTML = '';
        pageGames.forEach(game => {
            const card = document.createElement('div');
            card.classList.add('col-md-3');
            card.innerHTML = `
            <div class="card game-card" data-game-name="${game.name}">
                <img src="${game.img}" class="card-img-top" alt="${game.name}">
                <div class="card-body text-center">
                    <h5 class="card-title">${game.name}</h5>
                </div>
            </div>
        `;
            gameCardsContainer.appendChild(card);
        });

        
        // 3D  Effect
    function handleMouseMove(e, card) {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((centerY - y) / centerY) * 15; // แนวตั้ง
        const rotateY = ((centerX - x) / centerX) * -15; // แนวนอน

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
    }

   
    function handleMouseLeave(card) {
        card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)`;
    }

    
    document.querySelectorAll('.game-card').forEach((card) => {
        card.addEventListener('mousemove', (e) => handleMouseMove(e, card));
        card.addEventListener('mouseleave', () => handleMouseLeave(card));

       
        card.addEventListener('click', function () {
            document.querySelectorAll('.game-card').forEach(item => {
                item.classList.remove('border-c', 'selected');
            });

            this.classList.add('border-c', 'selected');
            const gameName = this.getAttribute('data-game-name');
            console.log('คุณเลือก:', gameName);
        });
    });

    }
</script>



@endsection