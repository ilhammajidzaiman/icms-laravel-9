</div>
</section>

<footer class="fa-w-1 pt-4">
    <div class="wrapper">
        <div class="container">
            <div class="text-center mt-5 py-5">
                <div>
                    Copyright &copy;
                    <?= date('Y') ;?>
                    <a class="text-decoration-none" href="{{ url('/') }}">{{ $config->app }}</a>.
                </div>
                <small class="text-secondary">
                    {{ $config->copyright }}
                </small>
            </div>
        </div>
    </div>
</footer>

<script src="{{ url('/') }}/plugins/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/') }}/plugins/js/jquery-3.6.0.min.js"></script>
</body>

</html>