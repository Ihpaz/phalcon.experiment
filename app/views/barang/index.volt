{# app/views/layout/template.volt #}

{% block contents_page %}
{{ flash.output() }}
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('#barang').DataTable({
                    serverSide: true,
                    ajax: {
                        url: '/barang/show',
                        method: 'POST'
                    },
                    columns: [
                        {data: "kodebarcode", searchable: false},
                        {data: "namabarang"},
                        {data: "satuan"},
                        {data: "harga", searchable: false},
                        {data: "action"}
                    ]
                });

                
            });
        </script>     
    <body>
        

        <div id="action" style="width: 100px;height:60px;margin-left: 40px;margin-top: 20px;">
            <!-- <input id="add" type="button" class="btn  btn-sm" value="Add Data" style="margin-left: 40px;margin-bottom: 20px;"> -->
            <a href="/barang/add" class="btn-info btn-sm ">Add Data</a>
        </div>
        <table id="barang" class="table">
            <thead>
                <th>Kode Barcode</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </body>
    {% endblock %}