<style>
    .webcam-capture,
    .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
    }

    #map {
        height: 200px;
        width: 100%;
    }
</style>

<!-- Include Google Maps API -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBCFvU8BXYrMhe1XYa4u2ntcCDRFHpsao&callback=initializeMap">
</script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="modal fade" id="presensiModal">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            {{-- <form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data" id="presensiForm">
                @csrf --}}
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="lokasi" id="lokasi">
                <div class="webcam-capture"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-outline-light btn-block" id="absen">Absen</button>
                <div id="map" class="mt-2"></div>
            </div>
            {{-- </form> --}}
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Map
        var map;
        var marker;
        var circle;
        var pengaturan_presensi;
        var lok;

        function initializeMap(latitude, longitude) {
            var mapOptions = {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 20
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            pengaturan_presensi = "{{ $pengaturan_presensi->lokasi }}";
            lok = pengaturan_presensi.split(",");
            var latitude_kantor = parseFloat(lok[0]);
            var longitude_kantor = parseFloat(lok[1]);
            var radius = parseFloat("{{ $pengaturan_presensi->radius }}");

            // Add marker for user's current location
            marker = new google.maps.Marker({
                position: {
                    lat: latitude,
                    lng: longitude
                },
                map: map
            });

            // Add circle for office location with given radius
            circle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map,
                center: {
                    lat: latitude_kantor,
                    lng: longitude_kantor
                },
                radius: radius // radius in meters
            });
        }

        // Get current position
        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
            initializeMap(position.coords.latitude, position.coords.longitude);
        }

        function errorCallback() {
            // Handle error
        }

        // var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $("#absen").click(function(e) {
            Webcam.snap(function(uri) {
                image = uri;
            });
            var lokasi = $("#lokasi").val();
            $.ajax({
                type: 'POST',
                url: '/presensi/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi
                },
                cache: false,
                success: function(respond) {
                    var status = respond.split("|");
                    if (status[0] == "success") {
                        Swal.fire({
                            title: 'Berhasil',
                            text: status[1],
                            icon: 'success'
                        })
                        setTimeout("location.href='/presensi'", 2000);
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: status[1],
                            icon: 'error'
                        })
                        setTimeout("location:href='/presensi'", 2000);
                    }
                }
            });
        });

        // Update Map when Modal is shown
        $('#presensiModal').on('shown.bs.modal', function() {
            map.invalidateSize();
        });

        // Update Map when Window is resized
        $(window).on('resize', function() {
            if (map) {
                map.invalidateSize();
            }
        });

        // Attach Webcam when the "Presensi Datang" button is clicked
        $('#checkIn').click(function() {
            // Mengubah judul modal menjadi "Presensi Datang" saat tombol "Check In" diklik
            $('#presensiModal .modal-title').text("Presensi Datang");
            // Menampilkan modal
            $('#presensiModal').modal('show');
            Webcam.set({
                width: 640,
                height: 480,
                image_format: 'jpeg',
                jpeg_quality: 80
            });
            Webcam.attach('.webcam-capture');
        });

        $('#checkOut').click(function() {
            // Mengubah judul modal menjadi "Presensi Pulang" saat tombol "Check Out" diklik
            $('#presensiModal .modal-title').text("Presensi Pulang");
            // Menampilkan modal
            $('#presensiModal').modal('show');
            Webcam.set({
                width: 640,
                height: 480,
                image_format: 'jpeg',
                jpeg_quality: 80
            });
            Webcam.attach('.webcam-capture');
        });

        // Detach Webcam when the modal is closed
        $('#presensiModal').on('hidden.bs.modal', function() {
            Webcam.reset();
        });
    });
</script>
