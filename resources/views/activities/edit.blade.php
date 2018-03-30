@extends('layout.default')

@section('content')
<div class="container">  
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">编辑活动</div>

        <div class="panel-body">

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ URL('activities/activity/'.$page->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="title">标题</label>
            <input type="text" name="title" class="form-control" required="required" value="{{ $page->title }}">
            <br>
            <label for="content">内容</label>
            <textarea name="content" rows="10" class="form-control" required="required"><?php echo str_replace('../../../', "../../../../", $page->content); ?></textarea>
            <br>
            <label for="start_register_time">开始时间</label>
            <input type="text" name="start_register_time" id="start_register_time" class="form-control" required="required" value="{{ substr($page->start_register_time, 0, 10) }}">
            <br>
            <label for="end_register_time">结束时间</label>
            <input type="text" name="end_register_time" id="end_register_time" class="form-control" required="required" value="{{ substr($page->end_register_time, 0, 10) }}">
            <br>
            <label for="end_register_time">最大人数</label>
            <input type="text" name="number" class="form-control" value="{{ $page->number }}">
            <br>
            <div style="text-align:center">
              <button class="btn btn-lg btn-info">保存</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<link href="{{ URL('../js/tinymce/skins/lightgray/content.min.css') }}" rel="stylesheet">
<link href="{{ URL('../css/plugin.css') }}" rel="stylesheet">
<script src="{{ URL('../js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL('../js/jquery-ui.min.js') }}"></script>
<script src="{{ URL('../js/datepicker.js') }}"></script>
<script type="text/javascript">
  tinymce.init({
    language:"zh_CN",
    selector: "textarea",
    theme: "modern",
    upload_action: "{{ URL('../plugins/upload.php') }}",//required
    upload_file_name: 'userfile',//required
    plugins: [
         "advlist autolink link image upload lists charmap preview hr pagebreak",
         "searchreplace fullscreen insertdatetime nonbreaking",
         "save contextmenu directionality emoticons paste textcolor"
   ],
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link upload image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: "Headers", items: [
        {title: "Header 1", format: "h1"},
        {title: "Header 2", format: "h2"},
        {title: "Header 3", format: "h3"},
        {title: "Header 4", format: "h4"},
        {title: "Header 5", format: "h5"},
        {title: "Header 6", format: "h6"}
      ]},
      {title: "Inline", items: [
          {title: "Bold", icon: "bold", format: "bold"},
          {title: "Italic", icon: "italic", format: "italic"},
          {title: "Underline", icon: "underline", format: "underline"},
          {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
          {title: "Superscript", icon: "superscript", format: "superscript"},
          {title: "Subscript", icon: "subscript", format: "subscript"},
          {title: "Code", icon: "code", format: "code"}
      ]},
      {title: "Blocks", items: [
          {title: "Paragraph", format: "p"},
          {title: "Blockquote", format: "blockquote"},
          {title: "Div", format: "div"},
          {title: "Pre", format: "pre"}
      ]},
      {title: "Alignment", items: [
          {title: "Left", icon: "alignleft", format: "alignleft"},
          {title: "Center", icon: "aligncenter", format: "aligncenter"},
          {title: "Right", icon: "alignright", format: "alignright"},
          {title: "Justify", icon: "alignjustify", format: "alignjustify"}
      ]}
    ],
    //convert_urls :false
 }); 
</script>
@endsection