<!DOCTYPE html>
<html class=''>
<head>
	<meta charset="utf-8">
    <link rel="icon" href="{{ URL('../images/favicon.ico') }}" type="image/x-icon"> 
    <link rel="shortcut icon" href="{{ URL('../images/favicon.ico') }}" type="image/x-icon">
    <title>活动报名系统</title>
    <style class="cp-pen-styles">
        body
        {
            background-color: #0A7189;
            color: #fff;
            font: 100% "Lato" , sans-serif;
            font-size: 1.8rem;
            font-weight: 300;
        }
        
        a
        {
            color: #75C6D9;
            text-decoration: none;
        }
        
        h3
        {
            margin-bottom: 1%;
        }
        
        ul
        {
            list-style: none;
            margin: 0;
            padding: 0;
            line-height: 50px;
        }
        
        li a:hover
        {
            color: #fff;
        }
        
        .center
        {
            text-align: center;
        }
        
        /* Search Bar Styling */
        form > *
        {
            vertical-align: middle;
        }
        
        .srchBtn
        {
            border: 0;
            border-radius: 7px;
            padding: 0 17px;
            background: #e74c3c;
            width: 99px;
            border-bottom: 5px solid #c0392b;
            color: #fff;
            height: 65px;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .srchBtn:active
        {
            border-bottom: 0px solid #c0392b;
        }
        
        .srchFld
        {
            border: 0;
            border-radius: 7px;
            padding: 0 17px;
            max-width: 404px;
            width: 40%;
            border-bottom: 5px solid #bdc3c7;
            height: 60px;
            color: #7f8c8d;
            font-size: 19px;
        }
        
        .srchFld:focus
        {
            outline-color: rgba(255, 255, 255, 0);
        }
        
        /* 404 Styling */
        .header
        {
            font-size: 12rem;
            font-weight: 700;
            margin: 2% 0 2% 0;
            text-shadow: 0px 3px 0px #7f8c8d;
        }
        
        /* Error Styling */
        .error
        {
            margin: -70px 0 2% 0;
            font-size: 7rem;
            text-shadow: 0px 3px 0px #7f8c8d;
            font-weight: 100;
        }
    </style>
</head>
<body>
    <section class="center">
        <article>
            <h1 class="header">
                401</h1>
            <p class="error">
                ERROR</p>
        </article>
        <article>
            <img src="{{ URL('../images/vovg1x.png') }}" alt="Funny Face">
        </article>
        <article>
            <h3>
                My Suggestions.</h3>
            <ul>
                <li><a href="/">Home</a></li>
            </ul>
        </article>
    </section>
</body>
</html>
