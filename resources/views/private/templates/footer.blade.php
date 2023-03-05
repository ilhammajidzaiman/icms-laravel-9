<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>

<footer class="main-footer text-xs">
    <strong>Copyright &copy;
        <?= date('Y');?> <a href="{{ url('/') }}">{{ config('app.name') }}</a>.
    </strong>
    <div class="float-right d-none d-sm-inline-block">
        {{ config('app.copyright') }}
    </div>
</footer>
</div>

<script src="{{ url('/') }}/plugins/admin-lte-3.2.0/plugins/jquery/jquery.min.js"></script>
<script src="{{ url('/') }}/plugins/admin-lte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/') }}/plugins/admin-lte-3.2.0/dist/js/adminlte.min.js"></script>
<script src="{{ url('/') }}/plugins/summernote-0.8.18-dist/summernote-bs4.min.js"></script>
<script src="{{ url('/') }}/assets/js/image-preview.js"></script>
<script src="{{ url('/') }}/assets/js/summernote-config.js"></script>


<script>
    $(document).ready(function() {
        $('.check-parent').on('click',function(){
            const level         = $(this).data('parent-level');
            const parent        = $(this).data('parent');
            const order         = $(this).data('parent-order');
            $.ajax({
                type: 'get',
                url: "{{ url($segmentUrl.'/parent') }}/"+level+"/"+parent+"/"+order,
                success: function(request){
                    alert("Akses menu diubah!");
                }
            });
        });

        $('.check-child').on('click',function(){
            const level         = $(this).data('child-level');
            const parent        = $(this).data('child-parent');
            const child         = $(this).data('child');
            const order         = $(this).data('child-order');
            $.ajax({
                type: 'get',
                url: "{{ url($segmentUrl.'/child') }}/"+level+"/"+parent+"/"+child+"/"+order,
                success: function(request){
                    alert("Akses sub menu diubah!");
                }
            });
        });
    });
</script>

</body>

</html>