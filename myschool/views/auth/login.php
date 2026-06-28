<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
    
</head>
<style>

/* ======================
   LOGIN
====================== */

.login-container{
    min-height:100vh;
    display:flex;
}

.login-left{
    flex:1;
    background:#4FA3E3;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
}

.login-left h1{
    font-size:48px;
}

.login-right{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    background:white;
    /* border:1px solid;
    height:50%; */
    margin:auto;
}

.login-box{
    width:400px;
}

.login-box h2{
    margin-bottom:20px;
    text-align:center;
}

.login-box input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:8px;
}

.login-box button{
    width:100%;
    padding:12px;
    background:#4FA3E3;
    color:white;
    border:none;
    border-radius:8px;
}

@media(max-width:768px){
     .login-container{
        flex-direction:column;
    }

    .login-left{
        min-height:200px;
    }

    .login-box{
        width:90%;
    }

}

</style>
<body>

<div class="login-container">

    <div class="login-left">
        <h1>MySchool</h1>
    </div>

    <div class="login-right">

        <div class="login-box">

            <h2>Connexion</h2>

            <form method="POST">

                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required>

                <input
                    type="password"
                    name="mdp"
                    placeholder="Mot de passe"
                    required>

                <button type="submit">
                    Se connecter
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>

