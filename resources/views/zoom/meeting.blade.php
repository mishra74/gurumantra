<!DOCTYPE html>
<html>

<head>

<title>Zoom Meeting</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Zoom SDK CSS -->
<link type="text/css" rel="stylesheet" href="https://source.zoom.us/3.5.0/css/bootstrap.css"/>
<link type="text/css" rel="stylesheet" href="https://source.zoom.us/3.5.0/css/react-select.css"/>

<!-- Vendor Libraries -->
<script src="https://source.zoom.us/3.5.0/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/3.5.0/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/3.5.0/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/3.5.0/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/3.5.0/lib/vendor/lodash.min.js"></script>

<!-- Zoom SDK -->
<script src="https://source.zoom.us/3.5.0/zoom-meeting-3.5.0.min.js"></script>

</head>
<body>

<h2>Zoom Meeting</h2>

<div id="zmmtg-root"></div>
<div id="aria-notify-area"></div>

<script>

ZoomMtg.setZoomJSLib('https://source.zoom.us/3.5.0/lib', '/av');

ZoomMtg.preLoadWasm();
ZoomMtg.prepareWebSDK();

const meetingNumber = "{{ $meetingNumber }}";
const password = "{{ $password }}";
const userName = "{{ $username }}";
const sdkKey = "{{ config('services.zoom.sdk_key') }}";

fetch("{{ route('zoom.signature') }}", {

method: "POST",

headers: {
"Content-Type": "application/json",
"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
},

body: JSON.stringify({
meetingNumber: meetingNumber
})

})
.then(res => res.json())
.then(response => {

let signature = response.signature;

ZoomMtg.init({

leaveUrl: "{{ url('/') }}",

success: function () {

ZoomMtg.join({

signature: signature,
sdkKey: sdkKey,
meetingNumber: meetingNumber,
passWord: password,
userName: userName,

success: function () {
console.log("Joined Meeting");
},

error: function (err) {
console.log(err);
}

});

}

});

});

</script>

</body>

</html>