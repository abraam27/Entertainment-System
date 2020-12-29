        <div id="footer">
            <div class="container footerCR">
                <p class="pullRight">Abraam Emad &copy; 2020</p>
            </div>
        </div>
        <script src="../../js/jquery-3.5.1.min.js"></script>
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="../../js/bootstrap-datetimepicker.ar.js" charset="UTF-8"></script>
        <script type="text/javascript">
                $('.form_date').datetimepicker({
                language:  'ar',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
        </script>
        <script type="text/javascript" src="../../js/plugins.js"></script>
        <script>
                (function(document) {
                        'use strict';

                        var TableFilter = (function(myArray) {
                                var search_input;

                                function _onInputSearch(e) {
                                        search_input = e.target;
                                        var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
                                        myArray.forEach.call(tables, function(table) {
                                                myArray.forEach.call(table.tBodies, function(tbody) {
                                                        myArray.forEach.call(tbody.rows, function(row) {
                                                                var text_content = row.textContent.toLowerCase();
                                                                var search_val = search_input.value.toLowerCase();
                                                                row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';
                                                        });
                                                });
                                        });
                                }

                                return {
                                        init: function() {
                                                var inputs = document.getElementsByClassName('search-input');
                                                myArray.forEach.call(inputs, function(input) {
                                                        input.oninput = _onInputSearch;
                                                });
                                        }
                                };
                        })(Array.prototype);

                        document.addEventListener('readystatechange', function() {
                                if (document.readyState === 'complete') {
                                        TableFilter.init();
                                }
                        });

                })(document);
        </script>
    </body>
</html>