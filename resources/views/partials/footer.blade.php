
<style>
    @media (max-width: 767.98px) {
        footer {
            font-size: 0.7rem !important;
        }
    }
</style>


<footer class="text-white pt-4 pb-3" style="background: linear-gradient(135deg, #1c1c1c, #000000); font-family: 'Prompt', sans-serif; font-size: 0.95rem;">
    <div class="container" style="max-width: 1440px;">
        <div class="row g-4">

            <!-- เกี่ยวกับเรา -->
            <div class="col-md-6 col-lg-3 text-center text-lg-start">
                <h5 class="fw-bold mb-2">เกี่ยวกับ EXP Topup</h5>
                <p class="mb-1"><strong>EXP-TOPUP</strong> เว็บไซต์ให้บริการเติมเงินเกมออนไลน์</p>
                <p class="mb-1">เว็บไซต์หลักคือ <a href="https://exptopup.com" class="text-info" target="_blank">exptopup.com</a></p>
                <p class="text-warning mb-0">⚠️ ระวังเว็บไซต์ปลอมที่แอบอ้างชื่อและบัญชีธนาคาร!</p>
            </div>

            <!-- บริการของเรา -->
            <div class="col-md-6 col-lg-3 text-center text-lg-start">
                <h5 class="fw-bold mb-2">บริการของเรา</h5>
                <ul class="list-unstyled lh-lg mb-0">
                    <li><i class="bi bi-controller me-2 text-info"></i>เติมเกม UID</li>
                    <li><i class="bi bi-key me-2 text-info"></i>เติมเกม ID-PASS</li>
                    <li><i class="bi bi-gift me-2 text-info"></i>แลกรางวัล</li>
                    <li><i class="bi bi-credit-card me-2 text-info"></i>เติมเครดิต</li>
                    <li><i class="bi bi-broadcast me-2 text-info"></i>ข่าวสาร</li>
                </ul>
            </div>

             <!-- แฟนเพจ Facebook -->
            <div class="col-md-6 col-lg-3 p-0 text-center text-lg-start">
            <h5 class="fw-bold mb-2">แฟนเพจ Facebook</h5>

            <div class="rounded overflow-hidden border border-dark mx-auto" style="max-width: 340px;">
                <iframe 
                    src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fswordsman3.mobile&tabs=timeline&width=340&height=220&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true"
                    width="100%" height="220"
                    style="border:none;overflow:hidden;" 
                    scrolling="no" frameborder="0" allowfullscreen="true"
                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                </iframe>
            </div>
        </div>


            <!-- ช่องทางติดต่อ + บริษัท -->
            <div class="col-md-6 col-lg-3 text-center text-white">
                <h5 class="fw-bold mb-2">ติดตามเรา</h5>
                <div class="d-flex justify-content-center flex-wrap gap-3 mb-3">
                    <a href="https://facebook.com/exptopup" target="_blank" title="Facebook">
                        <img src="{{ asset('images/facebook.png') }}" width="32" alt="Facebook">
                    </a>
                    <a href="https://line.me/ti/p/~@exptopup" target="_blank" title="X">
                        <img src="{{ asset('images/x.png') }}" width="32" alt="X">
                    </a>
                    <a href="https://youtube.com" target="_blank" title="YouTube">
                        <img src="{{ asset('images/youtube.png') }}" width="32" alt="YouTube">
                    </a>
                    <a href="https://instagram.com" target="_blank" title="Instagram">
                        <img src="{{ asset('images/ig.png') }}" width="32" alt="Instagram">
                    </a>
                    <a href="https://tiktok.com" target="_blank" title="TikTok">
                        <img src="{{ asset('images/tiktok.png') }}" width="32" alt="TikTok">
                    </a>
                </div>

                <h5 class="fw-bold mb-2 mt-5">บริษัทในเครือ</h5>
                <div class="footer-logos d-flex flex-wrap justify-content-center gap-3 mb-2">
                    <img src="{{ asset('images/logo-exp-up-company-original.png') }}" alt="EXP UP Logo" width="30">
                    <img src="{{ asset('images/logo-seasun.png') }}" alt="Seasun Logo" width="70">
                </div>

                <p class="small text-secondary m-0 mt-2">© {{ date('Y') }} EXP Topup. All rights reserved.</p>
            </div>

        </div>
    </div>
</footer>
