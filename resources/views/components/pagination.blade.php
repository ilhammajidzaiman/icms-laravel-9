<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="mb-3">
            Menampilkan
            {{ $pages->firstItem() }}
            ke
            {{ $pages->lastItem() }}
            entri, dari total
            {{ $pages->total() }}
            entri
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="float-sm-end">
            {{ $pages->onEachSide($side)->links() }}
        </div>
    </div>
</div>
