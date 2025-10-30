<x-app-layout>
    @section('title', 'About')
    <section class="relative bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen py-16">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-blue-900 mb-3">
                    About the <span class="text-blue-700">UNIPORT Repository</span>
                </h1>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base">
                    A digital archive designed to preserve, showcase, and share the academic legacy of the
                    <strong>Department of History and Diplomatic Studies</strong>, University of Port Harcourt.
                </p>
            </div>

            {{-- About Section --}}
            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-8 mb-12">
                <h2 class="text-2xl font-semibold text-blue-800 mb-3">About the Repository</h2>
                <p class="text-gray-700 leading-relaxed">
                    The UNIPORT Faculty Repository serves as a digital archive where research works, term papers,
                    seminar projects, fieldwork, and academic publications are securely stored and made accessible to
                    the university community and beyond. It stands as a bridge between past and future scholarship,
                    ensuring that the intellectual contributions of students and faculty remain preserved and available
                    for learning, research, and innovation.
                </p>
            </div>

            {{-- Vision & Mission --}}
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div class="bg-blue-900 text-white p-8 rounded-2xl shadow-md">
                    <h2 class="text-2xl font-semibold mb-3">Our Vision</h2>
                    <p class="leading-relaxed text-blue-100">
                        To become a leading digital academic repository in Africa — inspiring a culture of scholarly
                        excellence, knowledge preservation, and open access to intellectual works.
                    </p>
                </div>
                <div class="bg-white border border-gray-100 p-8 rounded-2xl shadow-sm">
                    <h2 class="text-2xl font-semibold text-blue-900 mb-3">Our Mission</h2>
                    <p class="text-gray-700 leading-relaxed">
                        To collect, organize, and showcase academic materials produced within the University of
                        Port Harcourt community — fostering accessibility, collaboration, and continuity in research
                        and historical documentation.
                    </p>
                </div>
            </div>

            {{-- Legacy Project --}}
            <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white rounded-2xl shadow-lg p-10 mb-12">
                <h2 class="text-2xl font-semibold mb-3">Legacy Project – Class of 2025</h2>
                <p class="leading-relaxed text-blue-100">
                    The <strong>2025 Graduating Class</strong> of the Department of History and Diplomatic Studies
                    conceived this repository as a legacy of academic preservation and continuity. It symbolizes
                    a commitment to intellectual growth and a gift to future generations of researchers, students,
                    and historians. The project was designed to ensure that every thesis, fieldwork, and publication
                    leaves a lasting digital footprint, strengthening the department’s scholarly heritage.
                </p>
                <div class="mt-6">
                    <blockquote class="border-l-4 border-blue-200 pl-4 italic text-blue-50 text-sm">
                        “Preserving the past, empowering the future — one submission at a time.”
                    </blockquote>
                </div>
            </div>

            {{-- Submission Guidelines --}}
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-8">
                <h2 class="text-2xl font-semibold text-blue-800 mb-4">Submission Guidelines</h2>
                <p class="text-gray-700 mb-4">
                    All contributors are encouraged to follow the submission guidelines below to maintain the quality
                    and consistency of materials uploaded to the repository.
                </p>
                <ul class="list-disc pl-6 space-y-2 text-gray-700 text-sm md:text-base">
                    <li>
                        Ensure that your work (thesis, term paper, seminar, or publication) is properly edited and free
                        of plagiarism.
                    </li>
                    <li>
                        Include a clear title page with your name, matriculation number, supervisor’s name, and
                        department details.
                    </li>
                    <li>
                        Upload only supported formats — PDF, images, audio, or video files (maximum of 6 files per submission).
                    </li>
                    <li>
                        Provide an abstract or summary highlighting the main ideas, methods, and conclusions of your work.
                    </li>
                    <li>
                        All submissions are reviewed and approved by the repository’s administrative team before
                        publication.
                    </li>
                    <li>
                        Students are advised to use their institutional email for verification during submission.
                    </li>
                </ul>
                <div class="mt-6">
                    <a href="{{ route('items.create') }}"
                       class="inline-block bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition">
                        Submit Your Work →
                    </a>
                </div>
            </div>

        </div>
    </section>
</x-app-layout>
