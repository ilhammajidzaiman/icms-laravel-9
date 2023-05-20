<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
        <h5>{{ config('app.name') }}</h5>
        <p>{{ config('app.copyright') }}</p>
    </div>
</aside>

<footer class="main-footer text-xs">
    <strong>Copyright &copy;
        <?= date('Y') ?> <a href="{{ route('/') }}">{{ config('app.name') }}</a>.
    </strong>
    <div class="float-right d-none d-sm-inline-block">
        {{ config('app.copyright') }}
    </div>
</footer>
</div>

<script src="{{ asset('/plugins/admin-lte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/plugins/admin-lte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/plugins/admin-lte-3.2.0/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/plugins/summernote-0.8.18-dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('/assets/js/summernote-config.js') }}"></script>

@yield('script')

</body>

</html>
