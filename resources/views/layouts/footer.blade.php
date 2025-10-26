<footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-lg font-semibold mb-3 text-white">About</h3>
                <p class="text-sm leading-relaxed">
                    The Faculty Repository of History & Diplomatic Studies is an academic archive preserving
                    and sharing student projects, term papers, fieldwork reports, and faculty publications.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-3 text-white">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                    <li><a href="{{ route('items.search') }}" class="hover:text-white">Search</a></li>
                    <li><a href="{{ route('categories.show', 'collections') }}" class="hover:text-white">Collections</a></li>
                    <li><a href="{{ route('items.create') }}" class="hover:text-white">Submit Work</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-semibold mb-3 text-white">Contact</h3>
                <ul class="space-y-2 text-sm">
                    <li>Email: <a href="mailto:facultyrepo@university.edu" class="underline hover:text-white">facultyrepo@university.edu</a></li>
                    <li>Address: Faculty of Arts, University Campus</li>
                    <li>Phone: +234 800 123 4567</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-4 text-sm text-gray-400 text-center">
            © {{ date('Y') }} Faculty Repository · All Rights Reserved.
        </div>
    </div>
</footer>
