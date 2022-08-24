@push('custom-scripts')
    <script>
        $(function() {
            'use strict';

            /**
             * Copy URL
             */
            $(document).on('click', '.copyUrl', function (e)
            {

                e.preventDefault();

                var $temp = $("<input>"),
                    text = $(this).data('url');
                $("body").append($temp);
                $temp.val(text).select();
                document.execCommand("copy");
                $temp.remove();

                alert('Ссылка скопирована в буфер обмена.');

            });

            /**
             * Editor Html
             */
            if ($('#edocuments_html_editor').length)
            {

                let edocuments_html_editor = ace.edit("edocuments_html_editor");
                edocuments_html_editor.setTheme("ace/theme/dracula");
                edocuments_html_editor.getSession().setMode("ace/mode/html");
                edocuments_html_editor.setOption({
                    showPrintMargin: false,
                    maxLines: edocuments_html_editor.session.getLength(),
                    wrap: true,
                    wrapMethod: 'auto',
                    indentedSoftWrap: true,
                    useWorker: true,
                    useSoftTabs: true,
                    navigateWithinSoftTabs: true,
                    overwrite: true,
                });

                edocuments_html_editor.setOption("wrap", true)
                ace.config.on("session", function(session) {
                    session.setOption("wrap", true)
                });

                edocuments_html_editor.container.style.height = "1000px";
                edocuments_html_editor.resize();

                $(document).on('submit', '.EDocumentsForm', function (e) {
                    $('.EDocumentsHtmlTextarea').text(edocuments_html_editor.getValue());
                });

            }

            /**
             * File Upload
             */
            $('#templateDocUpload').dropify({
                messages: {
                    'default': '{{ __( 'Нажмите или перетащите сюда файл .docx' ) }}',
                    'replace': '{{ __( 'Нажмите или перетащите сюда файл .docx' ) }}',
                    'remove':  '{{ __( 'Удалить' ) }}',
                    'error':   '{{ __( 'Произошла ошибка' ) }}'
                }
            });

            /**
             * Remove File
             */
            $(document).on('click', '.dropify-clear', function (e) {
                let $this       = $(this),
                    $inp_file   = $this.parent().find('[type="file"]'),
                    image       = $inp_file.data('default-file'),
                    id          = $inp_file.attr('id');

                if( image.length > 0 ) {
                    $inp_file.attr('data-default-file', '');
                    if( id === 'templateDocUpload' ) {
                        $this.parent().append('<input type="hidden" name="flush_file" value="remove" />');
                    }
                }

            });

            /**
             * Select Type Template
             */
            $('.template-extension-tabs').find('label').on('shown.bs.tab', function () {

                let $this       = $(this),
                    extension   = $this.data('id'),
                    $btnPlaceholders = $('.edocumentsBtnPlaceholders');

                $('.input-extension').val(extension);

                if( 1 !== extension ) {
                    $btnPlaceholders.hide();

                    $('.edocumentsListPlaceholders').addClass('hidden');
                    $('.edocumentsGeneralPanel').removeClass('hidden');

                }else{
                    $btnPlaceholders.show();
                }

            });

            /**
             *
             */
            $(document).on('click', '.edocumentsBtnPlaceholders', function (e) {

                e.preventDefault();

                $('.edocumentsListPlaceholders').toggleClass('hidden');
                $('.edocumentsGeneralPanel').toggleClass('hidden');

            });

            /**
             * Paste Placeholder in Editor
             * @type {NodeListOf<Element>}
             */
            $('#edocuments_html_editor').droppable({

                activeClass: "ui-state-default",
                hoverClass: "ui-state-hover",
                accept: ":not(.ui-sortable-helper)",

                drop: function(event, ui) {
                    var pos = editor.renderer.screenToTextCoordinates(event.clientX, event.clientY)
                    editor.session.insert(pos, ui.draggable.text())
                    return true
                }

            });

            /**
             * Paste Placeholder in Editor
             * @type {NodeListOf<Element>}
             */
            const buttonsDraggablePlaceholders = document.querySelectorAll(".btnDraggable")
            for (const button of buttonsDraggablePlaceholders) {
                button.addEventListener('dragstart', function(event) {
                    let placeholder = event.target.getAttribute("data-paceholder");
                    placeholder = placeholder.replace(/\s/g, '');
                    placeholder = placeholder.replace(/(\\|\/)/g,'')
                    event.dataTransfer.setData("text/plain", placeholder)
                });
            };

            /**
             *
             */
            $(document).on('click', '.edocumentsTriggerSubmit', function (e) {

                e.preventDefault();

                $('.EDocumentsForm').trigger('submit');

            });


        });


    </script>
@endpush

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ace-builds/ace.js') }}"></script>
@endpush
