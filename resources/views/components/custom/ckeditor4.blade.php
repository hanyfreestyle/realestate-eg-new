@php
    $locale = $getExtraAttributes()['locale'] ?? app()->getLocale();
@endphp
<div
    x-data="{
        initEditor() {
            const editorId = '{{ str_replace('.', '_', $getStatePath()) }}';
            this.$refs.editor.id = editorId;

            CKEDITOR.replace(editorId, {
                language: '{{ $locale }}',
                 height: 600,
                contentsLangDirection: '{{ $locale == 'ar' ? 'rtl' : 'ltr' }}',
                removePlugins : 'print,save,newpage,flash,another,form',
                toolbarGroups : [
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                    // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                    { name: 'insert', groups: [ 'insert' ] },
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'links', groups: [ 'links' ] },
                    { name: 'colors', groups: [ 'colors' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                    { name: 'styles', groups: [ 'styles' ] },
                    { name: 'tools', groups: [ 'tools' ] },
                ],
            });
            CKEDITOR.config.versionCheck = false ;
            CKEDITOR.config.fillEmptyBlocks = false;
            CKEDITOR.config.removeButtons = 'Save,NewPage,ExportPdf,Preview,Print,Templates,About,Smiley,SpecialChar,PageBreak,Iframe,Language,BidiRtl,BidiLtr,Subscript,Superscript,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Find,Replace,SelectAll,Scayt';

            CKEDITOR.instances[editorId].on('change', function() {
                const data = CKEDITOR.instances[editorId].getData();
                @this.set('{{ $getStatePath() }}', data);
            });

        }
    }"
    x-init="initEditor()"
    wire:ignore
>
    <textarea
        x-ref="editor"
        id="{{ str_replace('.', '_', $getStatePath()) }}"
        name="{{ $getStatePath() }}"
    >{!! $getState() !!}</textarea>
</div>

@push('scripts')
    <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
@endpush
