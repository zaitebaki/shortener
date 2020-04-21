<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title }}</title>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <main-component
        :content-data="{{ json_encode(__('content.statisticPage'), JSON_UNESCAPED_UNICODE) }}"
        :props-data="{{ json_encode($propsData, JSON_UNESCAPED_UNICODE) }}">
    </main-component>
  </div>
</body>
</html>
