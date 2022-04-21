    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
        <div class="container text-center">
        <small>Copyright &copy; ToDoアプリケーション（土山）</small>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $('#sort_select').on('change', function() {
                if ($(this).val != '') {
                    var url = './?sort=' + $(this).val();
                    if(url) {
                        window.location = url;
                    }
                }
                return false;
            });
        });
    </script>
</body>
</html>

<?php

    // End Database
    $selectClass->endDatabase();

?>