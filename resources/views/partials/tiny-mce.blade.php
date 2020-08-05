<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.1.2/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'.tiny_mce',
        height:500,
        plugins: "lists, wordcount,fullscreen, insertdatetime, table, link, codesample, code",
        toolbar: 'undo redo | styleselect | bold underline italic | fontsizeselect |alignleft aligncenter alignright alignjustify|bullist numlist| fullscreen link codesample| code',
        browser_spellcheck: true,
        codesample_languages: [
        {text: 'HTML/XML', value: 'markup'},
        {text: 'JavaScript', value: 'javascript'},
        {text: 'CSS', value: 'css'},
        {text: 'PHP', value: 'php'},
        {text: 'Ruby', value: 'ruby'},
        {text: 'Python', value: 'python'},
        {text: 'Java', value: 'java'},
        {text: 'C', value: 'c'},
        {text: 'C#', value: 'csharp'},
        {text: 'C++', value: 'cpp'}
        ],
        fontsize_formats: '9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 18pt 24pt 36pt 48pt'
    });
</script>

<style>
    .tox-statusbar__branding{
        display: none;
    }
</style>