<section>
    <div class="relative w-full h-32 lg:h-96">
        <img class="absolute h-full w-full object-cover object-center" src="{{ asset('assets/contact.png') }}"
            alt="nature image" />
        <div class="absolute inset-0 h-full w-full"></div>

    </div>
    <div class="-mt-16 mb-8 px-8">
        <div class="container mx-auto">
            <div
                class="py-6 flex justify-center rounded-xl border border-white bg-white shadow-md shadow-black/5 saturate-200">
                <section class=" py-2">
                    <div class=" text-center">
                        <h5
                            class="block antialiased tracking-normal font-semibold leading-snug text-blue-gray-900 mb-4 !text-base lg:!text-2xl">
                            Hubungi kami
                        </h5>
                        <h1
                            class="block antialiased tracking-normal font-semibold leading-tight text-blue-gray-900 mb-4 !text-xl lg:!text-5xl">
                            Ada yang bisa kami bantu ?
                        </h1>
                        <p
                            class="block antialiased leading-relaxed text-inherit mb-10 font-normal text-sm lg:text-lg lg:mb-20 mx-auto max-w-3xl !text-gray-500">
                            Kami siap sedia membantu kebutuhan anda dengan cara menghubungi kontak dibawah ini
                        </p>
                        <div class="grid grid-cols-1 gap-x-12 gap-y-6 lg:grid-cols-2 items-start">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50399.133025526105!2d110.33364480212218!3d-7.803248457427324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af7f955555555%3A0x40dbfd1901519f82!2sRS%20PKU%20Muhammadiyah%20Gamping!5e1!3m2!1sid!2sid!4v1738630989522!5m2!1sid!2sid"
                                width="600" height="450" class="w-full h-full lg:max-h-[510px] rounded-lg"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <form id="contactForm" class="flex flex-col gap-4 lg:max-w-sm">
                                <div class="flex gap-4">
                                    <button type="button" id="whatsappBtn"
                                        class="align-middle select-none font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] max-w-fit">
                                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                    </button>
                                    <button type="button" id="emailBtn"
                                        class="align-middle select-none font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] max-w-fit">
                                        <i class="fa-solid fa-envelope"></i> Email
                                    </button>
                                </div>
                                <div id="alert" class="hidden">
                                    <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-start text-blue-900 px-4 py-3 shadow-md mb-4"
                                        role="alert">
                                        <div>
                                            <div>
                                                <p class="font-bold">Informasi</p>
                                                <p class="text-sm">Silakan isi form di bawah ini. Atau manual dengan
                                                    <span id="hub"></span>.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="formFields">
                                    <div>
                                        <p
                                            class="block antialiased text-sm leading-normal text-inherit mb-2 text-left font-medium !text-gray-900">
                                            Nama Lengkap
                                        </p>
                                        <input id="name" placeholder="Kuli IT Tecno" name="name"
                                            class="peer w-full h-11 bg-transparent font-normal outline outline-0 focus:outline-0 disabled:bg-blue-gray-50 disabled:border-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border-t-transparent focus:border-t-transparent placeholder:opacity-0 focus:placeholder:opacity-100 text-sm px-3 py-3 rounded-md !border !border-gray-300 text-gray-900 placeholder:!text-gray-500 focus:!border-gray-900 focus:!border-2 focus:border-t-gray-900"
                                            required />
                                    </div>
                                    <div>
                                        <p
                                            class="block antialiased text-sm leading-normal text-inherit mb-2 text-left font-medium !text-gray-900">
                                            Deskripsikan kebutuhan menghubungi kami
                                        </p>
                                        <textarea id="message" rows="6" placeholder="Message" name="message"
                                            class="peer w-full min-h-[100px] bg-transparent font-normal outline outline-0 focus:outline-0 resize-y disabled:bg-blue-gray-50 disabled:border-0 disabled:resize-none transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 border-t-transparent focus:border-t-transparent text-sm px-3 py-2.5 rounded-[7px] !resize-none !border !border-gray-300 text-gray-900 placeholder:!text-gray-500 focus:!border-gray-900 focus:!border-2 focus:border-t-gray-900"
                                            spellcheck="false" required></textarea>
                                    </div>
                                    <button type="submit"
                                        class="align-middle select-none font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none bg-gray-900 w-full">
                                        Send message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('whatsappBtn').addEventListener('click', function() {
        document.getElementById('alert').classList.remove('hidden');
        document.getElementById('whatsappBtn').classList.add('bg-green-500', 'text-white');
        document.getElementById('emailBtn').classList.remove('bg-blue-500', 'text-white');
        document.getElementById('hub').innerHTML = "Nomer +{{ env('NO_PHONE') }}";

    });

    document.getElementById('emailBtn').addEventListener('click', function() {
        document.getElementById('alert').classList.remove('hidden');
        document.getElementById('emailBtn').classList.add('bg-blue-500', 'text-white');
        document.getElementById('whatsappBtn').classList.remove('bg-green-500', 'text-white');
        document.getElementById('hub').innerHTML = "Email {{ env('EMAIL') }}";
    });

    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const name = document.getElementById('name').value;
        const message = document.getElementById('message').value;
        const email = "{{ env('EMAIL') }}";
        const no_phone = "{{ env('NO_PHONE') }}";

        if (document.getElementById('whatsappBtn').classList.contains('bg-green-500')) {
            const whatsappUrl =
                `https://wa.me/${no_phone}?text=${encodeURIComponent(`Perkenalkan saya ${name}\ , ${message}`)}`;
            window.open(whatsappUrl, '_blank');
        } else if (document.getElementById('emailBtn').classList.contains('bg-blue-500')) {
            const emailUrl =
                `mailto:${email}?subject=Kontak dari ${name}&body=${encodeURIComponent(message)}`;
            window.open(emailUrl, '_blank');
        }
    });
</script>
