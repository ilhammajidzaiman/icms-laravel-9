<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>

<footer class="main-footer text-xs">
    <strong>Copyright &copy;
        <?= date('Y');?> <a href="{{ url('/') }}">{{ $config->app }}</a>.
    </strong>
    <div class="float-right d-none d-sm-inline-block">
        {{ $config->copyright }}
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
        $('.form-check-input').on('click',function(){
            const level_id = $(this).data('level');
            const menu_id = $(this).data('menu');
            const order = $(this).data('order');
            // alert("level id:"+level_id+", menu id:"+menu_id);
            $.ajax({
                type: 'get',
                url: "{{ url($segmentForm.'/ubah') }}/"+level_id+"/"+menu_id+"/"+order,
                // url: "/superadmin/master/access/ubah/"+level_id+"/"+menu_id+"/"+order,
                success: function(request){
                    alert("Akses menu diubah")
                }
            });
        });
    });
</script>

</body>

</html>