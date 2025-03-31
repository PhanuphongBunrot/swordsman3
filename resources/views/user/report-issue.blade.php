@extends('layouts.app')
@section('title', 'แจ้งปัญหา')

@section('content')
<div class="container py-5 text-white" style="max-width: 800px;">
    <h2 class="mb-4 text-center">📢 แจ้งปัญหาการใช้งาน</h2>

    <form method="POST" action="{{ route('report.issue.submit') }}">
        @csrf

        <!-- เลือกเกม -->
        <div class="mb-3">
            <label for="game" class="form-label">เลือกเกมที่พบปัญหา</label>
            <select class="form-select" name="game" id="game" required>
                <option value="">-- กรุณาเลือกเกม --</option>
                <option value="Swordsman3">Swordsman3</option>
                <option value="อื่น ๆ">อื่น ๆ</option>
            </select>
        </div>

        <!-- หัวข้อปัญหา -->
        <div class="mb-3">
            <label for="topic" class="form-label">หัวข้อปัญหา</label>
            <select class="form-select" name="topic" id="topic" required>
                <option value="">-- เลือกหัวข้อ --</option>
                <option value="เติมเงินไม่เข้า">เติมเงินไม่เข้า</option>
                <option value="ไม่ได้รับไอเทม">ไม่ได้รับไอเทม</option>
                <option value="บัญชีมีปัญหา">บัญชีมีปัญหา</option>
                <option value="อื่น ๆ">อื่น ๆ</option>
            </select>
        </div>

        <!-- รายละเอียดเพิ่มเติม -->
        <div class="mb-3">
            <label for="details" class="form-label">รายละเอียดปัญหา</label>
            <textarea class="form-control" name="details" id="details" rows="4" required placeholder="กรุณาอธิบายปัญหาให้ละเอียด เช่น วันที่ เวลา UID หรือชื่อผู้ใช้ที่เกี่ยวข้อง"></textarea>
        </div>

        <!-- ปุ่มส่ง -->
        <div class="text-center">
            <button type="submit" class="btn btn-info px-4">ส่งเรื่องแจ้งปัญหา</button>
        </div>
    </form>
</div>

@include('partials.footer')
@endsection
