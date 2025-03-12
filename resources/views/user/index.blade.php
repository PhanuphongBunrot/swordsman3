@extends('layouts.app')
@section('title', 'หน้าแรก')

@section('content')

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
        .carousel-caption{
            margin:0px;
            padding: 5px;
            font-size:10px;
        }
        .carousel-caption h5{
            font-size:12px;
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
                <div class="carousel-caption  d-md-block">
                    <h5>First Slide</h5>
                    <p>รายละเอียดเกี่ยวกับสไลด์แรก</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/02.jpg') }}" class="carousel-image" alt="...">
                <div class="carousel-caption  d-md-block">
                    <h5>Second Slide</h5>
                    <p>รายละเอียดเกี่ยวกับสไลด์ที่สอง</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/03.jpg') }}" class="carousel-image" alt="...">
                <div class="carousel-caption  d-md-block">
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


<!-- Package Section -->
<div class="package-container mt-4 mb-4">
    <div class="d-flex p-2" style="background-color:rgb(0, 0, 0); gap: 10px;">
        <button class="btn btn-icon" onclick="displayCards('หยก')">
            <p style="color:#41e0cf; margin: 0;"> <i class="bi bi-gem"></i> หยก</p>
        </button>
        <button class="btn btn-icon" onclick="displayCards('ทอง')">
            <p style="color:#41e0cf; margin: 0;"> <i class="bi bi-gem"></i> ทอง</p>
        </button>
        <button class="btn btn-icon" onclick="displayCards('ตำลึง')">
            <p style="color:#41e0cf; margin: 0;"> <i class="bi bi-gem"></i> ตำลึง</p>
        </button>
        <button class="btn btn-icon" onclick="displayCards('โปรโมชั่น')">
            <p style="color:#41e0cf; margin: 0;"> <i class="bi bi-gift"></i> โปรโมชั่น</p>
        </button>
    </div>
</div>

<!-- ส่วนแสดงการ์ด -->
<div class="container">
    <div class="row" id="package-cards">
        <!-- การ์ดจะถูกเพิ่มที่นี่โดย JavaScript -->
    </div>
</div>

<script>
    const cardData = {

        'หยก': [
                { title: "หยก 1", img: "{{ asset('images/gold1-60.png') }}" },
                { title: "หยก 2", img: "{{ asset('images/gold2-120.png') }}" },
                { title: "หยก 3", img: "{{ asset('images/gold3-300.png') }}" },
                { title: "หยก 4", img: "{{ asset('images/gold4-680.png') }}" },
                { title: "หยก 5", img: "{{ asset('images/gold5-1280.png') }}" },
                { title: "หยก 6", img: "{{ asset('images/gold6-2480.png') }}" },
                { title: "หยก 7", img: "{{ asset('images/gold7-3280.png') }}" },
                { title: "หยก 8", img: "{{ asset('images/gold8-6480.png') }}" }
        ],
        

        'ทอง': [
           { title: "ทอง 1", img: "{{ asset('images/gold1-60.png') }}" },
                { title: "ทอง 2", img: "{{ asset('images/gold2-120.png') }}" },
                { title: "ทอง 3", img: "{{ asset('images/gold3-300.png') }}" },
                { title: "ทอง 4", img: "{{ asset('images/gold4-680.png') }}" },
                { title: "ทอง 5", img: "{{ asset('images/gold5-1280.png') }}" },
                { title: "ทอง 6", img: "{{ asset('images/gold6-2480.png') }}" },
                { title: "ทอง 7", img: "{{ asset('images/gold7-3280.png') }}" },
                { title: "ทอง 8", img: "{{ asset('images/gold8-6480.png') }}" }
        ],
        'ตำลึง': [
            { title: "ตำลึง 1", img: "" },
            { title: "ตำลึง 2", img: "" },
            { title: "ตำลึง 3", img: "" },
            { title: "ตำลึง 4", img: "" },
            { title: "ตำลึง 5", img: "" },
            { title: "ตำลึง 6", img: "" },
            { title: "ตำลึง 7", img: "" },
            { title: "ตำลึง 8", img: "" }
        ],
        'โปรโมชั่น': [
            { title: "โปร 1", img: "" },
            { title: "โปร 2", img: "" },
            { title: "โปร 3", img: "" },
            { title: "โปร 4", img: "" },
            { title: "โปร 5", img: "" },
            { title: "โปร 6", img: "" },
            { title: "โปร 7", img: "" },
            { title: "โปร 8", img: "" }
        ]
    };

function displayCards(category) {
    console.log("เลือกหมวดหมู่: " + category);

    if (!cardData[category]) {
        console.error("ไม่มีข้อมูลหมวดหมู่นี้:", category);
        return;
    }

    const packageCardsContainer = document.getElementById('package-cards');
    packageCardsContainer.innerHTML = ''; // ล้างการ์ดก่อนเพิ่มใหม่

    const fragment = document.createDocumentFragment(); // ลดการ reflow

    cardData[category].forEach((card) => {
        const cardElement = document.createElement('div');
        cardElement.classList.add('package-card-wrapper', 'mb-4'); // ✅ ใช้คลาสที่รองรับ Responsive

        cardElement.innerHTML = `
            <div class="card package-card" data-package-name="${card.title}">
                <img src="${card.img}" class="card-img-top" alt="${card.title}" onerror="this.src='https://via.placeholder.com/150'">
                <div class="package-card-body text-center">
                    <h5 class="package-card-title">${card.title}</h5>
                </div>
            </div>
        `;

        fragment.appendChild(cardElement);
    });

    packageCardsContainer.appendChild(fragment); // เพิ่มการ์ดทั้งหมดพร้อมกัน
    apply3DEffectToPackageCards(); // เพิ่มเอฟเฟกต์ 3D hover
}

// ปรับให้ apply3DEffectToPackageCards() ใช้งานได้ดีขึ้น
function apply3DEffectToPackageCards() {
    document.querySelectorAll('.package-card').forEach((card) => {
        if (!card.dataset.listenerAdded) {
            card.addEventListener('mousemove', (e) => handleMouseMove(e, card));
            card.addEventListener('mouseleave', () => handleMouseLeave(card));
            card.addEventListener('click', function () {
                selectPackageCard(this);
                console.log('คุณเลือกแพ็กเกจ:', this.getAttribute('data-package-name'));
            });
            card.dataset.listenerAdded = "true"; // ป้องกันการเพิ่ม Event Listener ซ้ำซ้อน
        }
    });
}

// ใช้ requestAnimationFrame เพื่อให้แอนิเมชันลื่นขึ้น
function handleMouseMove(e, card) {
    requestAnimationFrame(() => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((centerY - y) / centerY) * 10;
        const rotateY = ((centerX - x) / centerX) * -10;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
    });
}

// รีเซ็ตการ์ดเมื่อเมาส์ออก
function handleMouseLeave(card) {
    requestAnimationFrame(() => {
        card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)`;
    });
}

// ฟังก์ชันเมื่อคลิกเลือกการ์ด
function selectPackageCard(card) {
    document.querySelectorAll('.package-card').forEach(item => {
        item.classList.remove('border-c', 'selected');
    });

    card.classList.add('border-c', 'selected');
}

// โหลดการ์ดหมวดหมู่แรกเมื่อหน้าเว็บโหลดเสร็จ
document.addEventListener("DOMContentLoaded", () => {
    displayCards('หยก');
});


</script>

<style>
.package-card {
    position: relative;
    cursor: pointer;
    transition: transform 0.15s ease-out, box-shadow 0.15s ease-out;
    transform-style: preserve-3d;
    border: 2px solid transparent;
    will-change: transform;
    backface-visibility: hidden;
    
}

/*  Layout  */
.package-card-wrapper {
    flex: 0 0 25%; /* ค่าเริ่มต้น: แถวละ 4 คอลัมน์ */
    max-width: 25%;
}
/* เอฟเฟกต์ขอบเรืองแสงเฉพาะการ์ดที่ถูกเลือก */
.package-card.selected {
    border: 4px solid transparent;
    border-image-slice: 1;
    animation: borderAnimation 4s infinite alternate linear;
    scale:1.08;
}

/* คีย์เฟรมสำหรับขอบเรืองแสง */
@keyframes borderAnimation {
    0% { border-image-source: linear-gradient(45deg, #41e0cf, #ffcc00, #ff5e62); }
    50% { border-image-source: linear-gradient(135deg, #ff5e62, #41e0cf, #ffcc00); }
    100% { border-image-source: linear-gradient(225deg, #ffcc00, #41e0cf, #ff5e62); }
}

/* เอฟเฟกต์ Hover */
.package-card:hover {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
}

@media only screen and (max-width: 767px) {
    .package-card-wrapper {
        flex: 0 0 50%;  /* แถวละ 2 คอลัมน์ */
        max-width: 50%;
        padding: 5px;  /* ลดระยะห่าง */
    }

    .package-card {
        transform: scale(0.85) !important;  /* ล็อกขนาดการ์ดไว้ที่ 85% */
        transition: box-shadow 0.3s ease-out; /*  ลบ transition ของ transform ออก */
    }

    /* Hover เปลี่ยนเฉพาะเงา ไม่ขยาย */
    .package-card:hover {
        transform: scale(0.85) !important; 
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }
}



</style>

<!-- End Package Section -->


<!-- Section: ช่องทางการชำระเงิน -->

<div class="paymentmethod-container mt-4">
    <div class="section-header p-1 bg-black ">
        <h4 class="" style="color:#41e0cf;">ช่องทางการชำระเงิน</h4>
    </div>

    <div class="containers">
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <div class="card payment-card" data-payment-name="ธนาคารกสิกรไทย">
                    <img src="{{ asset('images/kbank.png') }}" class="payment-icon" alt="ธนาคารกสิกรไทย">
                    <span class="payment-text">ธนาคารกสิกรไทย</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card payment-card" data-payment-name="ธนาคารกรุงไทย">
                    <img src="{{ asset('images/ktb.png') }}" class="payment-icon" alt="ธนาคารกรุงไทย">
                    <span class="payment-text">ธนาคารกรุงไทย</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card payment-card" data-payment-name="ทรูมันนี่">
                    <img src="{{ asset('images/truemoney.png') }}" class="payment-icon" alt="ทรูมันนี่">
                    <span class="payment-text">ทรูมันนี่</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card payment-card" data-payment-name="พรอมเพย์">
                    <img src="{{ asset('images/promptpay.png') }}" class="payment-icon" alt="พรอมเพย์">
                    <span class="payment-text">พรอมเพย์</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* สไตล์ของการ์ดชำระเงิน */
.payment-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    border-radius: 5px;
    transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
    cursor: pointer;
    border: 2px solid transparent;
    transform-style: preserve-3d;
    will-change: transform;
    perspective: 1000px;
}

/* ขนาดไอคอน */
.payment-icon {
    width: 80px;
    height: 80px;
    object-fit: contain;
}

/* ข้อความช่องทางชำระเงิน */
.payment-text {
    font-size: 18px;
    font-weight: bold;
    color: black;
}

/* เอฟเฟกต์ขอบเรืองแสงเมื่อเลือก */
.payment-card.selected {
    border: 3.5px solid transparent;
    border-image-slice: 1;
    animation: borderAnimation 4s infinite alternate linear;
  scale:1.08;
}

/* เอฟเฟกต์ Hover */
.payment-card:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
}

/* 3D Hover Effect */
.payment-card:hover {
    transform: scale(1.05) rotateX(5deg) rotateY(-5deg);
}

/* คีย์เฟรมสำหรับขอบเรืองแสง */
@keyframes borderAnimation {
    0% { border-image-source: linear-gradient(45deg, #41e0cf, #ffcc00, #ff5e62); }
    50% { border-image-source: linear-gradient(135deg, #ff5e62, #41e0cf, #ffcc00); }
    100% { border-image-source: linear-gradient(225deg, #ffcc00, #41e0cf, #ff5e62); }
}

/* ✅ Responsive: จอเล็กให้เป็น 2 คอลัมน์ */
@media only screen and (max-width: 767px) {
    .col-md-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .payment-card {
        padding: 10px;
    }

    .payment-icon {
        width: 60px;

        height: 60px;
    }

    .payment-text {
        font-size: 16px;
    }
}
</style>

<script>
function apply3DEffectToPaymentCards() {
    document.querySelectorAll('.payment-card').forEach((card) => {
        if (!card.dataset.listenerAdded) {
            card.addEventListener('mousemove', (e) => handleMouseMove(e, card));
            card.addEventListener('mouseleave', () => handleMouseLeave(card));
            card.addEventListener('click', function () {
                selectPaymentCard(this);
                console.log('คุณเลือกช่องทางการชำระเงิน:', this.getAttribute('data-payment-name'));
            });
            card.dataset.listenerAdded = "true"; // ป้องกันการเพิ่ม Event Listener ซ้ำซ้อน
        }
    });
}

function handleMouseMove(e, card) {
    requestAnimationFrame(() => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = ((centerY - y) / centerY) * 15;
        const rotateY = ((centerX - x) / centerX) * -15;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
    });
}

// รีเซ็ตการ์ดเมื่อเมาส์ออก
function handleMouseLeave(card) {
    requestAnimationFrame(() => {
        card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)`;
    });
}

// ฟังก์ชันเมื่อคลิกเลือกการ์ด
function selectPaymentCard(card) {
    document.querySelectorAll('.payment-card').forEach(item => {
        item.classList.remove('border-c', 'selected');
    });

    card.classList.add('border-c', 'selected');
}

// โหลดการ์ดหมวดหมู่แรกเมื่อหน้าเว็บโหลดเสร็จ
document.addEventListener("DOMContentLoaded", () => {
    apply3DEffectToPaymentCards();
});
</script>

<!--END Section: ช่องทางการชำระเงิน -->





<!-- Section: ปุ่มทำการชำระเงิน -->


<div class="payment-button-container mt-4">
    <div class="section-header p-1 bg-black">
        <h4 class="" style="color:#41e0cf;">ทำการชำระเงิน</h4>
    </div>

    <div class="container text-center mt-3 mb-4">
        <button id="pay-now-btn" class="btn payment-button" disabled>ชำระเงิน</button>
    </div>
</div>

<style>

/* Section ปุ่มทำการชำระเงิน */
.payment-button-container {
    margin-top: 20px;
}

/* ปุ่มชำระเงิน */
.payment-button {
    background: #b0b0b0;  
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 12px 30px;
    border: none;
    border-radius: 10px;
    cursor: not-allowed;
    transition: transform 0.2s ease-out, box-shadow 0.2s ease-out, background 0.3s ease-in-out;
    will-change: transform;
    perspective: 1000px;
}


.payment-button.enabled {
    background: #41e0cf;
    cursor: pointer;
}

.payment-button.enabled:hover {
    transform: scale(1.05) rotateX(5deg) rotateY(-5deg);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    background: #34c9b0; /* เปลี่ยนสีเมื่อ Hover */
}

.payment-button.enabled:active {
    background: #2db6a1; /* สีเข้มขึ้นเมื่อกด */
    transform: scale(1);
}


@media only screen and (max-width: 767px) {
    .payment-button {
        font-size: 16px;
        padding: 10px 20px;
    }
}
</style>

<script>
// รีเซ็ต localStorage เมื่อหน้าเว็บโหลดใหม่
document.addEventListener("DOMContentLoaded", function() {
    localStorage.clear(); // ล้างค่าทั้งหมดเมื่อรีเฟรช
    checkSelection(); // รีเซ็ตปุ่มชำระเงิน

    document.querySelectorAll('.game-card').forEach((card) => {
        card.addEventListener("click", function () {
            selectGame(this.getAttribute("data-game-name"));
        });
    });

    document.querySelectorAll('.package-card').forEach((card) => {
        card.addEventListener("click", function () {
            selectPackage(this.getAttribute("data-package-name"));
        });
    });

    document.querySelectorAll('.payment-card').forEach((card) => {
        card.addEventListener("click", function () {
            selectPayment(this.getAttribute("data-payment-name"));
        });
    });

    document.getElementById("pay-now-btn").addEventListener("click", function() {
        if (!this.disabled) {
            console.log("ดำเนินการชำระเงิน...");
               Swal.fire({
            title: "ชำระเงินสำเร็จ!",
            html: '<i class="fas fa-check-circle custom-swal-success-icon"></i>', // ✅ ไอคอนเรืองแสง
            showConfirmButton: false,
            timer: 2000,
            background: "#222",
            color: "#fff",
            width: "400px",
            customClass: {
                popup: "custom-swal-success-popup",
                title: "custom-swal-success-title",
                confirmButton: "custom-swal-success-button"
            }
        });
        }
    });
});

// ตรวจสอบว่าผู้ใช้เลือกครบทั้ง 3 
function checkSelection() {
    const selectedGame = localStorage.getItem("selectedGame");
    const selectedPackage = localStorage.getItem("selectedPackage");
    const selectedPayment = localStorage.getItem("selectedPayment");

    const payButton = document.getElementById("pay-now-btn");

    if (selectedGame && selectedPackage && selectedPayment) {
        payButton.disabled = false;
        payButton.classList.add("enabled");
    } else {
        payButton.disabled = true;
        payButton.classList.remove("enabled");
    }
}

// ฟังก์ชันบันทึกค่าเมื่อคลิกเลือกการ์ด
function selectGame(gameName) {
    localStorage.setItem("selectedGame", gameName);
    console.log("เลือกเกม:", gameName);
    checkSelection();
}

function selectPackage(packageName) {
    localStorage.setItem("selectedPackage", packageName);
    console.log("เลือกแพ็คเกจ:", packageName);
    checkSelection();
}

function selectPayment(paymentMethod) {
    localStorage.setItem("selectedPayment", paymentMethod);
    console.log("เลือกวิธีชำระเงิน:", paymentMethod);
    checkSelection();
}
</script>


<!-- END Section: ปุ่มทำการชำระเงิน-->
 



<!--Alert-->
<!-- CSS ปรับแต่ง SweetAlert2 -->
<style>
    /* ✅ ซ่อนไอคอนเริ่มต้นทั้งหมด */
    .swal2-icon {
        display: none !important;
    }

    /* ✅ สไตล์ของ Popup */
    .custom-swal-success-popup {
        border-radius: 15px !important;
        box-shadow: 0px 0px 15px rgba(0, 255, 100, 0.7) !important;
        width: 60% !important;
        max-width: 350px !important;
        text-align: center !important;
        background: #222 !important; /* พื้นหลังดำ */
    }

    /* ✅ ปรับขนาด Title */
    .custom-swal-success-title {
        font-size: 22px !important;
        font-weight: bold !important;
        color: #00ff99 !important;
        text-shadow: 0px 0px 10px rgba(0, 255, 100, 0.7);
    }

    /* ✅ ปรับไอคอน Success */
    .custom-swal-success-icon {
        font-size: 60px !important;  /* ✅ ปรับขนาดไอคอน */
        color: #00ff99 !important;
        margin-bottom: 10px !important;
        text-shadow: 0px 0px 10px rgba(0, 255, 100, 0.7); /* ✅ เพิ่มเรืองแสง */
    }

    /* ✅ ปรับขนาดข้อความ */
    .custom-swal-success-text {
        font-size: 16px !important;
        color: #d4ffd4 !important;
        margin-top: 10px !important;
    }

    /* ✅ ปรับขนาดปุ่ม */
    .custom-swal-success-button {
        background-color: #00cc66 !important;
        color: white !important;
        font-size: 16px !important;
        padding: 8px 16px !important;
        border-radius: 6px !important;
        transition: all 0.3s ease-in-out;
    }

    /* ✅ เอฟเฟค Hover ปุ่ม */
    .custom-swal-success-button:hover {
        background-color: #00994d !important;
        box-shadow: 0px 0px 10px rgba(0, 255, 100, 0.7);
    }
</style>





<!--EndAlert-->

@endsection