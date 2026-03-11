<!DOCTYPE html>
<html>

<head>
    <title>Gurumantra Live Class joining</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Zoom SDK CSS -->
    <link rel="stylesheet" href="https://source.zoom.us/3.5.0/css/bootstrap.css">
    <link rel="stylesheet" href="https://source.zoom.us/3.5.0/css/react-select.css">
</head>

<body>

<h2>Gurumantra Live Class</h2>

<div id="zmmtg-root"></div>
<div id="aria-notify-area"></div>

<!-- Zoom SDK Dependencies -->
<script src="https://source.zoom.us/3.5.0/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/3.5.0/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/3.5.0/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/3.5.0/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/3.5.0/lib/vendor/lodash.min.js"></script>

<!-- Zoom SDK -->
<script src="https://source.zoom.us/3.5.0/zoom-meeting-3.5.0.min.js"></script>

<script>

ZoomMtg.setZoomJSLib('https://source.zoom.us/3.5.0/lib', '/av');
ZoomMtg.preLoadWasm();
ZoomMtg.prepareWebSDK();

const meetingNumber = "{{ $meetingNumber }}";
const userName = "{{ $username }}";
const sdkKey = "{{ config('services.zoom.sdk_key') }}";
const role = 0;

// if password empty send ""
const passWord = "{{ $password ?? '' }}";

fetch("{{ route('zoom.signature') }}", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
        meetingNumber: meetingNumber,
        role: role
    })
})
.then(response => response.json())
.then(data => {

    const signature = data.signature;

    ZoomMtg.init({

        leaveUrl: "{{ url('/') }}",
        patchJsMedia: true,

        success: function () {

            ZoomMtg.join({

                signature: signature,
                sdkKey: sdkKey,
                meetingNumber: meetingNumber,
                userName: userName,
                passWord: passWord, // empty string if no password

                success: function () {
                    console.log("Meeting joined successfully");
                },

                error: function (error) {
                    console.error("Join error:", error);
                }

            });

        },

        error: function (error) {
            console.error("Init error:", error);
        }

    });

})
.catch(error => {
    console.error("Signature API error:", error);
});

</script>

</body>
</html>