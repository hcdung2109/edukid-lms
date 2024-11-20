@extends('layouts.master')

@section('content')
    <div id="pspdfkit" style="width: 100%; height: 100vh;"></div>
@endsection

@section('scripts')
    <script>
        // We need to inform PSPDFKit where to look for its library assets, i.e. the location of the `pspdfkit-lib` directory.
        const baseUrl = `${window.location.protocol}//${window.location.host}/`;

        PSPDFKit.load({
            baseUrl,
            container: "#pspdfkit",
            document: "/remote.docx"
        })
            .then(instance => {
                console.log("PSPDFKit loaded", instance);
            })
            .catch(error => {
                console.error(error.message);
            });


    </script>
@endsection
