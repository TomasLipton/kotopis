<x-app-layout>

    <main>
        <div id="gallery">
            @foreach ($footprints as $footprint)
{{--                <x-footprint :footprint="$footprint"></x-footprint>--}}
                @foreach ($footprint->media as $media)
                    <figure class="modal-open " onclick="toggleModal2('modal-id', '{{$media->public_url}}')">
                        <img src="{{$media->public_url}}" alt="Pink and blue clouds at sunset. " title="Photo by Jeremy Doddridge for Unsplash">
                        <figcaption>
                            {{$footprint->created_at->format('d M Y')}}
{{--                            <br>--}}
{{--                            8 PM, Summer--}}
                        </figcaption>
                    </figure>
                @endforeach

            @endforeach

            <figure>
                <div>
                    <div>
                        <h2>Привет </h2>
                        <p>Меня зовут кошечка Майли</p>
{{--                        <p><br><small>Related work : <br><a target="_blank" href="https://codepen.io/wakana-k/pen/oNJxbPw">Hover animation version</a></small></p>--}}
                    </div>
                </div>
            </figure>
{{--            --}}
        </div>
    </main>

</x-app-layout>

<div class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modal-id">
    <!--
      Background backdrop, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class=" min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                <div class="mt-2_">
                    <img id="modal-img" />
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"  onclick="toggleModal2('modal-id')">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>--}}

<script>

    document.addEventListener(
        "keydown",
        (event) => {
            if (event.key === "Escape" && document.body.classList.contains('modal-active')) {
                toggleModal2('modal-id')
            }
        }
    );

    function toggleModal2(modalID, e){
        if (e) {
            document.getElementById('modal-img').src = e
        }

        document.getElementById(modalID).classList.toggle("hidden");
        // document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.body.classList.toggle("modal-active");
        // document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }

</script>



{{--

https://codepen.io/wakana-k/pen/WNLrWMm
https://codepen.io/wakana-k/pen/oNJxbPw
--}}
