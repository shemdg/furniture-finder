<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Finder - AI Powered</title>
    <link rel="icon" href="https://www.svgrepo.com/show/424304/furniture-house-living-17.svg" type="image/svg+xml">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-clifford: #da373d;
            --font-sans: InterVariable, sans-serif;
            --font-sans--font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🛋️ Furniture Finder</h1>
    <p class="subtitle">Tell us what you're looking for, and our AI will create a personalized collection for you.</p>

    <form id="furnitureForm" method="POST" action="generate.php">
        <div class="form-group">
            <label for="furniture_type" class="block text-sm font-medium text-gray-900 mb-2">
                What type of furniture are you looking for?
            </label>

            <select id="furniture_type" name="furniture_type" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                <option value="">Select categories...</option>

                <optgroup label="🛋️ Living Room">
                    <option value="Sofa">Sofa / Couch</option>
                    <option value="Sectional Sofa">Sectional Sofa</option>
                    <option value="Living Room Set">Living Room Set</option>
                    <option value="TV Stand">TV Stand / Entertainment Center</option>
                    <option value="Coffee Table">Coffee Table</option>
                    <option value="Side Table">Side Table / End Table</option>
                    <option value="Accent Chair">Accent Chair / Recliner</option>
                    <option value="Bookshelf">Bookshelf / Display Cabinet</option>
                    <option value="Console Table">Console Table</option>
                </optgroup>

                <optgroup label="🛏️ Bedroom">
                    <option value="Bed Frame">Bed / Bed Frame</option>
                    <option value="Mattress">Mattress</option>
                    <option value="Bedroom Set">Bedroom Set</option>
                    <option value="Nightstand">Nightstand / Bedside Table</option>
                    <option value="Dresser">Dresser / Chest</option>
                    <option value="Wardrobe">Wardrobe / Closet</option>
                    <option value="Vanity Table">Vanity Table</option>
                    <option value="Bed Bench">Bed Bench / Ottoman</option>
                </optgroup>

                <optgroup label="🍽️ Dining Room">
                    <option value="Dining Table">Dining Table</option>
                    <option value="Dining Chair">Dining Chair</option>
                    <option value="Dining Set">Dining Set</option>
                    <option value="Bar Stool">Bar Stool / Counter Stool</option>
                    <option value="Buffet">Buffet / Sideboard</option>
                </optgroup>

                <optgroup label="💼 Home Office">
                    <option value="Desk">Desk / Writing Table</option>
                    <option value="Office Chair">Office Chair</option>
                    <option value="Filing Cabinet">Filing Cabinet</option>
                    <option value="Office Bookshelf">Office Bookshelf</option>
                </optgroup>

                <optgroup label="📦 Storage">
                    <option value="Accent Cabinet">Accent Cabinet</option>
                    <option value="Display Shelf">Display Shelf</option>
                    <option value="Room Divider">Room Divider</option>
                    <option value="Shoe Rack">Shoe Rack / Organizer</option>
                    <option value="Bar Cart">Bar Cart</option>
                </optgroup>
            </select>
        </div>

        <div class="form-group">

            <div class="form-group">
                <label for="priceSlider" class="block text-sm font-medium text-gray-900 mb-2">
                    What's your budget? <span id="priceDisplay" class="font-semibold text-blue-600">₱0 - ₱5,000</span>
                </label>

                <div class="relative pt-6">
                    <!-- Hidden input for actual value -->
                    <input type="hidden" name="budget" id="budgetValue" value="₱0 - ₱5,000">

                    <!-- Slider -->
                    <input type="range"
                           id="priceSlider"
                           min="0"
                           max="4"
                           value="0"
                           step="1"
                           list="priceMarkers"
                           class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">

                    <!-- Custom markers with labels -->
                    <div class="flex justify-between px-1 mt-2">
                        <span class="text-xs text-gray-500">₱0-5k</span>
                        <span class="text-xs text-gray-500">₱5-25k</span>
                        <span class="text-xs text-gray-500">₱25-50k</span>
                        <span class="text-xs text-gray-500">₱50-100k</span>
                        <span class="text-xs text-gray-500">₱100-185k</span>
                    </div>
                </div>

                <!-- Budget ranges mapping (hidden) -->
                <div id="priceRanges" data-ranges='["₱0 - ₱5,000", "₱5,000 - ₱25,000", "₱25,000 - ₱50,000", "₱50,000 - ₱100,000", "₱100,000 - ₱185,000"]'></div>
            </div>
        </div>

        <div class="form-group">
            <label for="style" class="block text-sm font-medium text-gray-900 mb-2">
                What's your preferred style?
            </label>

            <select name="style" id="style" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                <option value="">Choose a style</option>

                <optgroup label="🌟 Most Popular at OurHome.ph">
                    <option value="Modern">Modern - Clean & minimalist</option>
                    <option value="Scandinavian">Scandinavian - Light, functional (like IKEA)</option>
                    <option value="Contemporary">Contemporary - Current trends</option>
                </optgroup>

                <optgroup label="🛋️ Classic Styles">
                    <option value="Traditional">Traditional - Classic, ornate details</option>
                    <option value="Transitional">Transitional - Mix of classic & modern</option>
                    <option value="Mid-Century">Mid-Century - 1950s/60s retro style</option>
                </optgroup>

                <optgroup label="🌿 Natural & Rustic">
                    <option value="Farmhouse">Farmhouse - Rustic, country charm</option>
                    <option value="Industrial">Industrial - Metal, raw materials</option>
                    <option value="Coastal">Coastal - Beachy, light colors</option>
                </optgroup>

                <optgroup label="🎨 Creative & Colorful">
                    <option value="Bohemian">Bohemian - Colorful, eclectic mix</option>
                    <option value="Tropical">Tropical - Vibrant, island vibe</option>
                    <option value="Minimalist">Minimalist - Simple, clutter-free</option>
                </optgroup>
            </select>

            <div class="mt-2 text-xs text-gray-500">
                💡 Based on ourhome.ph's actual furniture collections
            </div>
        </div>

        <button type="submit" id="submitBtn">Generate My Collection</button>
        <div class="mt-6">
            <p class="text-center text-gray-500 text-xs">📊 Data based on <a href="https://ourhome.ph/collections/furniture" class="text-blue-500" target="_blank">ourhome.ph</a></p>
        </div>

        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>🤖 AI is creating your personalized furniture collection...</p>
        </div>

        <div class="error" id="error"></div>
    </form>
</div>

<script src="js/script.js" defer></script>

</body>
</html>