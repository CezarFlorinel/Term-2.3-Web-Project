<div class="mb-4 relative">
    <label class="block font-bold text-white mb-2 mt-8" for="artists">Artists</label>
    <div class="mt-1 relative">
        <select id="js_artists"
            class="form-select block w-full pl-3 pr-10 py-2 border border-gray-300 shadow-sm rounded-md appearance-none bg-white"
            onchange="this.style.color='black'">
            <option class="text-black" value="All_Artists">All Artists</option>
            <?php foreach ($artists as $artist): ?>
                <option class="text-black">
                    <?php echo htmlspecialchars($artist->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
            </svg>
        </div>
    </div>
</div>