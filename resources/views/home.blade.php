@extends('layouts.app')
@section('title', 'หน้าแรก')

@section('content')
<style>
    .game-card {
        cursor: pointer;
        transition: box-shadow 0.3s ease;
    }

    .game-card.border-c {
        border: 5px solid #6439FF;
    }

    .game-card.selected .card-title {
        color: #6439FF;
    }

    #game-cards .card {
        width: 220px;
        /* กำหนดความกว้าง */
        height: 160px;
        /* กำหนดความสูง */
        margin: 10px;
        /* ระยะห่างระหว่างการ์ด */
        display: flex;
        flex-direction: column;
        /* ทำให้เนื้อหาภายในการ์ดวางในแนวตั้ง */
        justify-content: space-between;
        /* จัดวางเนื้อหาภายในการ์ด */
        overflow: hidden;
        /* ป้องกันการหลุดของเนื้อหาภายในการ์ด */
    }

    #game-cards .card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* ปรับขนาดภาพให้เต็มการ์ดโดยไม่ทำให้ภาพเบี้ยว */
    }


    .section-header {
        /* background-color: #40E0D0; */
        padding: 5px;
        border-radius: 5px;
        color: #000000;
        margin-bottom: 5px;
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
        color: #6439FF;
        border: 2px solid #6439FF;
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
        background-color: #6439FF;
        /* เปลี่ยนพื้นหลังเป็นสีม่วงเมื่อเม้าชี้ */
        color: white;
        /* เปลี่ยนสีตัวอักษรเป็นขาว */
    }

    .pagination-buttons button:active {
        background-color: #4b28cc;
        color: white;
        /* เปลี่ยนเป็นสีม่วงเข้มเมื่อคลิก */
    }
</style>

<div class="container">
    <div class=" section-header">
        <h4>1.เลือกเกม</h4>
        <div class="pagination-buttons">
            <div class="pagination-buttons">
                <button id="prevBtn" onclick="navigateCards('prev')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="nextBtn" onclick="navigateCards('next')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

        </div>
    </div>
    <div class="row" id="game-cards">
        <!-- การ์ดจะถูกเพิ่มที่นี่โดย JavaScript -->
    </div>
</div>

<div class="container mt-4">
    <div class="row section-header">
        <h4>2.เลือกแพ็คเกจ</h4>
    </div>
</div>


<script>
    const games = [{
            name: "Swordsman3",
            img: "{{ asset('images/Logo Sword Man 3 Final.jpg') }}"
        },
        {
            name: "เกม B",
            img: "https://via.placeholder.com/350x200"
        },
        {
            name: "เกม C",
            img: "https://via.placeholder.com/350x200"
        },
        {
            name: "เกม D",
            img: "https://via.placeholder.com/350x200"
        },
        {
            name: "เกม E",
            img: "https://via.placeholder.com/350x200"
        },
        {
            name: "เกม F",
            img: "https://via.placeholder.com/350x200"
        },
        {
            name: "เกม G",
            img: "https://via.placeholder.com/350x200"
        },
        {
            name: "เกม H",
            img: "https://via.placeholder.com/350x200"
        },
    ];

    const cardsPerPage = 4;
    let currentPage = 0;

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
                    <img src="${game.img}" class="card-img-top" alt="${game.name}" >
                    <div class="card-body text-center">
                        <h5 class="card-title">${game.name}</h5>
                    </div>
                </div>
            `;
            gameCardsContainer.appendChild(card);
        });
    }

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

        // เพิ่มการตั้งค่า listener สำหรับการคลิกการ์ดใหม่ทุกครั้ง
        document.querySelectorAll('.game-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.game-card').forEach(item => {
                    item.classList.remove('border-c');
                    item.classList.remove('selected');
                });

                this.classList.add('border-c');
                this.classList.add('selected');

                const gameName = this.getAttribute('data-game-name');
                console.log('คุณเลือก: ' + gameName);
            });
        });
    }
</script>



@endsection