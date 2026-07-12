/* ===========================================
   register-bootstrap.css
=========================================== */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Plus Jakarta Sans',sans-serif;
    background:#eef1fb;
}

/* Background */

.bg-auth{
    background:#eef1fb;
}

/* Card */

.auth-card{
    width:100%;
    max-width:1100px;
    min-height:700px;
    border-radius:25px;
    overflow:hidden;
}

/* ===========================
   LEFT PANEL
=========================== */

.left-panel{
    background:linear-gradient(135deg,#5b30d6,#7b4bff);
    position:relative;
    overflow:hidden;
}

.left-panel::before{
    content:'';
    width:260px;
    height:260px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    position:absolute;
    right:-80px;
    bottom:-80px;
}

.left-panel::after{
    content:'';
    width:180px;
    height:180px;
    border-radius:50%;
    background:rgba(255,255,255,.05);
    position:absolute;
    top:50px;
    right:20px;
}

.left-content{
    padding:55px 45px;
    position:relative;
    z-index:2;
    display:flex;
    flex-direction:column;
    height:100%;
}

.brand{
    margin-bottom:70px;
}

.brand-icon{
    width:42px;
    height:42px;
    border-radius:12px;
    background:rgba(255,255,255,.18);
    display:flex;
    justify-content:center;
    align-items:center;
}

.hero-text{
    flex:1;
}

.hero-text h1{
    font-size:42px;
    line-height:1.2;
    margin-bottom:20px;
}

.hero-text p{
    color:rgba(255,255,255,.8);
    font-size:15px;
    line-height:28px;
}

/* Feature */

.feature-list{
    margin-top:35px;
}

.feature-item{
    display:flex;
    align-items:center;
    margin-bottom:18px;
}

.check-icon{
    width:32px;
    height:32px;
    border-radius:10px;
    background:rgba(255,255,255,.18);
    display:flex;
    justify-content:center;
    align-items:center;
    color:#fff;
    font-weight:bold;
    margin-right:12px;
}

.feature-item span{
    color:white;
    font-size:15px;
}

/* ===========================
   RIGHT PANEL
=========================== */

.form-wrapper{
    padding:60px;
}

.team-badge{
    margin-bottom:25px;
}

.form-control{
    height:50px;
    border-radius:12px;
    border:1px solid #dee2e6;
}

.form-control:focus{
    border-color:#6f42c1;
    box-shadow:0 0 0 .20rem rgba(111,66,193,.15);
}

.input-group .btn{
    border-radius:0 12px 12px 0;
}

.form-label{
    font-weight:600;
    color:#444;
}

.btn-primary{
    background:#5b30d6;
    border:none;
    border-radius:12px;
    height:52px;
    font-weight:700;
    transition:.3s;
}

.btn-primary:hover{
    background:#4d22c7;
    transform:translateY(-2px);
}

.progress{
    height:5px;
    border-radius:10px;
}

.password-progress{
    margin-top:8px;
}

.progress-bar{
    transition:.3s;
}

.form-check-label a{
    text-decoration:none;
    font-weight:600;
}

.form-check-label a:hover{
    text-decoration:underline;
}

hr{
    opacity:.15;
}

/* Footer */

.text-muted.small{
    font-size:13px;
}

/* ===========================
   Responsive
=========================== */

@media(max-width:992px){

.left-panel{

display:none;

}

.form-wrapper{

padding:40px;

}

.auth-card{

border-radius:20px;

}

}

@media(max-width:768px){

.form-wrapper{

padding:30px 22px;

}

.hero-text h1{

font-size:30px;

}

.btn-primary{

height:48px;

}

}

@media(max-width:576px){

.auth-card{

margin:15px;

}

.form-wrapper{

padding:25px 18px;

}

h2{

font-size:28px;

}

}