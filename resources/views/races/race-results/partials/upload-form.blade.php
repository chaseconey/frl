<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css">

<form action="{{ route($route, $race->id) }}" method="POST" enctype="multipart/form-data"
      class="mt-8 dropzone">

    @csrf

    <div class="space-y-8 divide-y divide-gray-200 fallback">
        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="sm:col-span-6">
                <label for="cover_photo" class="block text-sm font-medium text-gray-700">
                    Upload Results
                </label>
                <div
                    class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md fallback">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                             viewBox="0 0 48 48" aria-hidden="true">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="results"
                                   class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Upload a file</span>
                                <input id="results" name="results" type="file" class="sr-only" accept="application/JSON">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            json up to 10MB
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-5">
            <div class="flex justify-end">
                <button type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </div>
    </div>

</form>

<script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone",{
        maxFilesize: 3,  // 3 mb
        acceptedFiles: ".json",
        paramName: 'results',
        maxFiles: 1,
        dictDefaultMessage: 'Drop race results here to upload'
    });
    myDropzone.on("sending", function(file, xhr, formData) {
        formData.append("_token", CSRF_TOKEN);
    });
    myDropzone.on('success', function () {
        location.reload();
    });
    myDropzone.on('error', function (e) {
        const parsedResponse = e?.xhr?.response;

        // Default error
        let error = "There was an error during upload";

        // If we sent a structured error from backend
        if (parsedResponse) {
            const parsedError = JSON.parse(parsedResponse);
            let firstError = null;

            // errors would be present for validation issues
            if ('errors' in parsedError) {
                firstError = parsedError.errors[Object.keys(parsedError.errors)[0]][0];
            }

            // all other exceptions would have a message
            const errorMessage = parsedError?.message;

            error = firstError ?? errorMessage;
        }

        const notyf = new Notyf();
        notyf.error(error);
    });
</script>
