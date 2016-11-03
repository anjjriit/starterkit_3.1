<script src="{{ asset($config->get('assets_path') . '/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset($config->get('assets_path') . '/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset($config->get('assets_path') . '/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset($config->get('assets_path') . '/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset($config->get('assets_path') . '/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset($config->get('assets_path') . '/plugins/selectize/js/standalone/selectize.js') }}"></script>
@if ('en' !== config('app.locale'))
    <script src="{{ asset($config->get('assets_path') . '/plugins/datepicker/locales/bootstrap-datepicker.'.config("app.locale").'.js') }}"></script>
    <script src="{{ asset($config->get('assets_path') . '/plugins/select2/js/i18n/'.config('app.locale').'.js') }}"></script>
@endif
<script type="text/javascript" src="{{ asset($config->get('assets_path') . '/plugins/fancybox/source/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
<script src="{{ asset($config->get('assets_path') . '/js/app.js') }}"></script>
<script src="{{ asset($config->get('assets_path') . '/js/scripts.js') }}"></script>