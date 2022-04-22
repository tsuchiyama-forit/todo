    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
        <div class="container text-center">
        <small>Copyright &copy; ToDoアプリケーション（土山）</small>
        </div>
    </footer>
    <!-- Bootstrap用のJS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- ソートするためのJS -->
    <script>
        $(function() {
            $('#sort_select').on('change', function() {
                if ($(this).val != '') {
                    var url = './?sort=' + $(this).val();
                    if (findGetParameter('page_no') != null) {
                        url = url + '&page_no=' + findGetParameter('page_no');
                    }
                    if(url) {
                        window.location = url;
                    }
                }
                return false;
            });
        });

        // 今実在しているGetパラメーターを取得する
        function findGetParameter(parameterName) {
            var result = null,
                tmp = [];
            location.search
                .substr(1)
                .split("&")
                .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                });
            return result;
        }

    </script>
</body>
</html>

<?php

    // End Database
    $selectClass->endDatabase();

?>