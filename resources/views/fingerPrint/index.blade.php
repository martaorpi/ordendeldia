
@php
    use Backpack\CRUD\app\Library\Widget;

// script widget - works the same for both local paths and CDN
  Widget::add()->type('script')->content('assets/js/custom-script.js');
  Widget::add()->type('script')->content('https://code.jquery.com/ui/1.12.0/jquery-ui.min.js');
  Widget::add()->type('script')
              ->content('https://code.jquery.com/ui/1.12.0/jquery-ui.min.js')
              ->integrity('sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=')
              ->crossorigin('anonymous');

  // style widget - works the same for both local paths and CDN
  Widget::add()->type('style')->content('assets/css/custom-style.css');
  Widget::add()->type('style')->content('https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0-beta.58/dist/themes/light.css');
  Widget::add()->type('style')
              ->content('https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0-beta.58/dist/themes/light.css')
              ->integrity('sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=')
              ->crossorigin('anonymous');
@endphp