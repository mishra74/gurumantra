<!DOCTYPE html>
<html>

<head>
    <title>Gurumantra Live Class Hosting</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://source.zoom.us/3.5.0/css/bootstrap.css" />
    <link rel="stylesheet" href="https://source.zoom.us/3.5.0/css/react-select.css" />

</head>

<body>

    <h2>Start Live Class</h2>

    <div id="zmmtg-root"></div>
    <div id="aria-notify-area"></div>

    <script src="https://source.zoom.us/3.5.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/3.5.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/3.5.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/3.5.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/3.5.0/lib/vendor/lodash.min.js"></script>

    <script src="https://source.zoom.us/3.5.0/zoom-meeting-3.5.0.min.js"></script>

    <script>
    ZoomMtg.setZoomJSLib('https://source.zoom.us/3.5.0/lib', '/av');
    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareWebSDK();

    const meetingNumber = "{{ $meetingNumber }}";
    const userName = "{{ $username }}";
    const sdkKey = "{{ config('services.zoom.sdk_key') }}";
    const role = 1;
    const passWord = "{{ $password ?? '' }}";

    fetch("{{ route('zoom.signature') }}", {

            method: "POST",

            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
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

                success: function() {

                    ZoomMtg.join({

                        signature: signature,
                        sdkKey: sdkKey,
                        meetingNumber: meetingNumber,
                        userName: userName,
                        userEmail: "mishra74881@gmail.com",
                        passWord: passWord,

                        success: function() {
                            console.log("Meeting Started");
                        },

                        error: function(error) {
                            console.log(error);
                        }

                    });

                },

                error: function(error) {
                    console.log(error);
                }

            });

        })

        .catch(error => {
            console.log("Signature API error:", error);
        });
    </script>

</body>

</html>