@extends('layouts.app')
@section('title', 'แจ้งปัญหา')

@section('content')
<!-- 🔹 แบนเนอร์แจ้งปัญหา -->
<div class="report-banner">
    <img src="{{ asset('images/report-issue-banner.png') }}" alt="แจ้งปัญหา" class="img-fluid w-100">
</div>

<style>
.report-banner img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 0;
}
</style>

<div class="container py-5" style="max-width: 800px;">
    <h2 class="text-center mb-4"><i class="bi bi-megaphone text-danger"></i> แจ้งปัญหาการใช้งาน</h2>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="category" class="form-label">ประเภทปัญหา *</label>
            <select id="category" name="category" class="form-select" required>
                <option value="">-- โปรดเลือก --</option>
                <option>การเติมเงิน</option>
                <option>ปัญหาบัญชี</option>
                <option>บัคภายในเกม</option>
                <option>ปัญหาเกี่ยวกับเว็บไซต์</option>
                <option>อื่น ๆ</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="game" class="form-label">เกมที่มีปัญหา *</label>
            <select id="game" name="game" class="form-select" required>
                <option value="">-- โปรดเลือกเกม --</option>
                <option>Swordsman 3</option>
                <option>เกม B</option>
                <option>เกม C</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="login_method" class="form-label">ช่องทางที่ใช้ Login *</label>
            <select id="login_method" name="login_method" class="form-select" required>
                <option value="">-- โปรดเลือก --</option>
                <option>Facebook</option>
                <option>Google</option>
                <option>Apple</option>
                <option>Email</option>
                <option>อื่น ๆ</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">เซิฟเวอร์ *</label>
            <input type="text" class="form-control" name="game_id" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ชื่อในเกม *</label>
            <input type="text" class="form-control" name="in_game_name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ชื่อแพ็กเกจที่เติม *</label>
            <input type="text" class="form-control" name="package_name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ราคาที่เติม *</label>
            <input type="text" class="form-control" name="topup_price" required>
        </div>

        <div class="mb-3">
            <label class="form-label">วันที่พบปัญหา *</label>
            <input type="date" class="form-control" name="problem_date" required>
        </div>

        <div class="mb-3">
            <label class="form-label">อีเมลที่ติดต่อได้ *</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">เบอร์โทรศัพท์ *</label>
            <input type="text" class="form-control" name="phone" required>
        </div>

        <div class="mb-3">
            <label class="form-label">รายละเอียดปัญหา *</label>
            <textarea class="form-control" name="details" rows="4" placeholder="กรุณาอธิบายปัญหาให้ละเอียด เช่น วันที่ เวลา UID หรือชื่อผู้ใช้ที่เกี่ยวข้อง" required></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label">แนบรูปภาพหลักฐาน (ถ้ามี)</label>
            <input type="file" class="form-control" name="screenshot">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-info text-white px-4">ส่งเรื่องแจ้งปัญหา</button>
        </div>
    </form>
</div>
@include('partials.footer')
@endsection
