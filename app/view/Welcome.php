<!DOCTYPE html>
<html>
<head>
    <title>Marble</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700,900" rel="stylesheet">
    <style>
        *, *:before, *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border: 0;
            margin: 0;
            padding: 0;
            font-size: 100%;
            font-family: inherit;
            line-height: inherit;
        }

        html, body {
            -webkit-height: 100%;
            -moz-height: 100%;
            height: 100%;
            transform-style: preserve-3d;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
        }

        .center {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            width: 720px;
            margin: 0 auto;
        }

        .logo {
            background-color: #a5b8ae;
            color: #FFFFFF;
            margin: 0 auto;
            width: 128px;
            height: 128px;
            transform-style: preserve-3d;
            border-radius: 4px;
            -webkit-transition: background-color .4s;
            -moz-transition: background-color .4s;
            transition: background-color .4s;
        }

        .logo:hover {
            background-color: #42b877;
        }

        .logo span {
            opacity: 0;
            font-weight: 900;
            font-size: 4em;
            display: block;
            text-align: center;
            position: relative;
            top: 50%;
            transform: translateY(-55%);
        }

        p {
            font-size: 1.75em;
            line-height: 135%;
            margin-top: 1em;
        }

        em {
            font-weight: 900;
            font-style: normal;
        }
    </style>
</head>
<body>
    <div class="center">
        <div class="logo">
            <span>m</span>
        </div>
        <p><em>Marble</em> is a tiny PHP framework that's easy to use for people making tiny web applications on apache/mysql/php stacks who want fast setup.</p>
    </div>
</body>
</html>
