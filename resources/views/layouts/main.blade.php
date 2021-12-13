<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COACHTECH</title>
  <style>


/*ヘッダー部分*/
.header-main{
  width:1340px;
  margin:0 auto;
  text-align:left;
}

/*メイン部分*/
.contents-main{
  width:1440px;
  height:600px;
  background-color:#e7e7e7;
  margin:0 auto;

}


/*フッター部分*/
  .contents-box{
    display:table;
    text-align:center;
    width:100%;
  }

  small{
    display:table-cell;
    vertical-align:middle;
  }

  </style>
</head>
<body>
  <header>@yield('header')
  <div class="header-main">
  <h1>Atte</h1>
  </div>
  </header>

  <main>@yield('contents')
    <div class="contents-main">
    </div>
  </main>

  <footer>@yield('footer')
    <div class="contents-box">
      <small>Atte,inc</small>
    </div>
  </footer>
</body>
</html>