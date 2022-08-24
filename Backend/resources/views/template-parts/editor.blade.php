@push('custom-scripts')
    <script>
        $(function() {
            'use strict';

            /**
             * Editor Html
             */
            if ($('#constructor_dinamyc_html_editor').length)
            {

                let constructor_dinamyc_html_editor = ace.edit("constructor_dinamyc_html_editor");
                constructor_dinamyc_html_editor.setTheme("ace/theme/dracula");
                constructor_dinamyc_html_editor.getSession().setMode("ace/mode/html");
                constructor_dinamyc_html_editor.setOption({
                    showPrintMargin: false,
                    maxLines: constructor_dinamyc_html_editor.session.getLength(),
                    wrap: true,
                    wrapMethod: 'auto',
                    indentedSoftWrap: true,
                    useWorker: true,
                    useSoftTabs: true,
                    navigateWithinSoftTabs: true,
                    overwrite: true,
                });

                constructor_dinamyc_html_editor.setOption("wrap", true)
                ace.config.on("session", function(session) {
                    session.setOption("wrap", true)
                });

                constructor_dinamyc_html_editor.container.style.height = "500px";
                constructor_dinamyc_html_editor.resize();

                $(document).on('submit', '.ConstructorDinamycForm', function (e) {
                    $('.ConstructorDinamycHtmlTextarea').text(constructor_dinamyc_html_editor.getValue());
                });

            }

            /**
             * File Upload
             */
            $('#imageUpload, #iconUpload, #faviconUpload, #avatarUpload, #videoPoster, #fileUpload, #imageLogoMobileUpload').dropify({
                messages: {
                    'default': '{{ __( 'Нажмите или перетащите сюда файлы' ) }}',
                    'replace': '{{ __( 'Нажмите или перетащите сюда файлы' ) }}',
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
                    if( id === 'imageUpload' ) {
                        $this.parent().append('<input type="hidden" name="flush_image" value="remove" />');
                    }
                    if( id === 'iconUpload' ) {
                        $this.parent().append('<input type="hidden" name="flush_icon" value="remove" />');
                    }
                    if( id === 'faviconUpload' ) {
                        $this.parent().append('<input type="hidden" name="flush_favicon" value="remove" />');
                    }
                    if( id === 'avatarUpload' ) {
                        $this.parent().append('<input type="hidden" name="flush_avatar" value="remove" />');
                    }
                    if( id === 'videoPoster' ) {
                        $this.parent().append('<input type="hidden" name="flush_poster" value="remove" />');
                    }
                    if( id === 'filePoster' ) {
                        $this.parent().append('<input type="hidden" name="flush_file" value="remove" />');
                    }
                    if( id === 'imageLogoMobileUpload' ) {
                        $this.parent().append('<input type="hidden" name="flush_logo_mobile" value="remove" />');
                    }
                }

            });

            /**
             * Editor Html
             */
            if ($('#pages_html_editor').length)
            {

                let pages_html_editor = ace.edit("pages_html_editor");
                pages_html_editor.setTheme("ace/theme/dracula");
                pages_html_editor.getSession().setMode("ace/mode/html");
                pages_html_editor.setOption({
                    showPrintMargin: false,
                    maxLines: pages_html_editor.session.getLength(),
                    wrap: true,
                    wrapMethod: 'auto',
                    indentedSoftWrap: true,
                    useWorker: true,
                    useSoftTabs: true,
                    navigateWithinSoftTabs: true,
                    overwrite: true,
                });

                pages_html_editor.setOption("wrap", true)
                ace.config.on("session", function(session) {
                    session.setOption("wrap", true)
                });

                pages_html_editor.container.style.height = "1000px";
                pages_html_editor.resize();

                $(document).on('submit', '.pagesForm', function (e) {
                    $('.PagesHtmlTextarea').text(pages_html_editor.getValue());
                });

            }

            /**
             * Tabs Template
             */
            if( $('#tabListPagesTemplate').length )
            {

                /**
                 * Shown Tab
                 */
                $('#tabListPagesTemplate a[data-toggle="tab"]').on('shown.bs.tab', function (e)
                {

                    const template_type = $(e.target).data("type") // activated tab
                    $('.pageTemplate').val(template_type)

                });

            }

            /**
             * Editor Blocks Html
             */
            if ($('#blocks_html_editor').length)
            {
                let blocks_html_editor = ace.edit("blocks_html_editor");
                blocks_html_editor.setTheme("ace/theme/dracula");
                blocks_html_editor.getSession().setMode("ace/mode/html");
                blocks_html_editor.setOption({
                    showPrintMargin: false,
                    maxLines: blocks_html_editor.session.getLength(),
                    wrap: true,
                    wrapMethod: 'auto',
                    indentedSoftWrap: true,
                    useWorker: true,
                    useSoftTabs: true,
                    navigateWithinSoftTabs: true,
                    overwrite: true,
                });

                blocks_html_editor.setOption("wrap", true)
                ace.config.on("session", function(session) {
                    session.setOption("wrap", true)
                });

                blocks_html_editor.container.style.height = "500px";
                blocks_html_editor.resize();

                $(document).on('submit', '.blocksForm', function (e) {
                    $('.BlocksHtmlTextarea').text(blocks_html_editor.getValue());
                });
            }



        });
    </script>
@endpush

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/ace-builds/ace.js') }}"></script>
@endpush
