
<!-- BEGIN GLOBAL AND THEME VENDORS -->
<script src="{{cdn('newTheme/globals/js/global-vendors.js')}}"></script>
<!-- END GLOBAL AND THEME VENDORS -->
<script src="{{cdn('newTheme/globals/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js')}}"></script>
<script src="{{cdn('newTheme/globals/plugins/switchery/dist/switchery.min.js')}}"></script>
<script src="{{cdn('newTheme/globals/scripts/forms-switch.js')}}"></script>
<script src="{{cdn('newTheme/globals/scripts/forms-switchery.js')}}"></script>

<script src="{{cdn('js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>


<!-- PLEASURE -->
<script src="{{cdn('newTheme/globals/js/pleasure.js')}}"></script>
<!-- ADMIN 1 -->
<script src="{{cdn('newTheme/admin1/js/layout.js')}}"></script>

<!-- BEGIN INITIALIZATION-->
<script>
    $(document).ready(function () {
        ///////////////Domain Validation Rule//////////////////
        jQuery.validator.addMethod("domain", function(value, element) {
            return /^([a-zA-Z0-9])+\.([a-zA-Z0-9]{2,4})+$/.test(value);
        }, "Please specify the correct Domain Name like: yourdomain.com");
        ///////////////End Domain Validation Rule//////////////////

        Pleasure.init();
        Layout.init();
    });
</script>
<!-- END INITIALIZATION-->

<!-- BEGIN Google Analytics -->
<script>
//    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
//
//    ga('create', Pleasure.settings.ga.urchin, Pleasure.settings.ga.url);
//    ga('send', 'pageview');
</script>
<!-- END Google Analytics -->





<script>

    function ChangeStatus(entity,entity_id){ //CHANGE STATUS OF ALL ENTITY IN LIST VIEW
        console.log('ss');
        $("#"+entity+"_grid").jsGrid("cancelEdit");
        {{--$.ajax({--}}
            {{--url: "{{url('/ajax/status')}}" + '/' + entity  +'/'+entity_id--}}
        {{--}).success(function (response) {--}}
            {{--var obj=$('#'+entity+entity_id+' span');--}}
            {{--if(response=='actived'){--}}
                {{--obj.removeClass();--}}
                {{--obj.html('Active');--}}
                {{--obj.addClass('label label-success');--}}
            {{--}else if(response=='disable'){--}}
                {{--obj.removeClass();--}}
                {{--obj.html('Inactive');--}}
                {{--obj.addClass('label label-danger');--}}
            {{--}else if(response =="You don't have permission"){--}}
                {{--alert("You don't have permission");--}}
            {{--}else if(response =="please Select your Client"){--}}
                {{--alert("please Select your Client");--}}
            {{--}--}}
        {{--})--}}
    }
    $(document).ready(function() {

        //////////////////////////////SYSTEM MSG//////////////////////////////////////
        @if(isset($errors))
        @foreach($errors->get('msg') as $error)
        {{--$.smallBox({--}}
            {{--@if($errors->get('success')[0] == true)--}}
            {{--title: "Success",--}}
            {{--@elseif($errors->get('success')[0] == false)--}}
            {{--title: "Warning",--}}
            {{--@endif--}}
            {{--content: "{{$error}}",--}}
            {{--@if($errors->get('success')[0] == true)--}}
            {{--color: "#739E73",--}}
            {{--icon: "fa fa-check",--}}
            {{--@elseif($errors->get('success')[0] == false)--}}
            {{--color: "#C46A69",--}}
            {{--icon: "fa fa-bell",--}}
            {{--@endif--}}
            {{--timeout: 8000--}}
        {{--});--}}
        @endforeach
        @endif
        });
</script>


