<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8"/>
    <title>:: {{ env('APP_NAME')}} ::</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    @vite(['resources/css/app.css', 'resources/js/common.js'])
</head>

<body>
<div class="flex flex-col h-screen">
