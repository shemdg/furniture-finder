<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Finder - AI Powered</title>
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
            <label for="furniture_type">What type of furniture are you looking for?</label>
            <select id="furniture_type" name="furniture_type" required>
                <option value="">Select a type...</option>
                <option value="Sofa">Sofa</option>
                <option value="Bed">Bed</option>
                <option value="Dining Table">Dining Table</option>
                <option value="Chair">Chair</option>
                <option value="Desk">Desk</option>
                <option value="Coffee Table">Coffee Table</option>
                <option value="Bookshelf">Bookshelf</option>
                <option value="Wardrobe">Wardrobe</option>
                <option value="TV Stand">TV Stand</option>
                <option value="Nightstand">Nightstand</option>
                <option value="Other">Other (please specify)</option>
            </select>

            <div id="other_furniture_container" style="display: none; margin-top: 15px;">
                <label for="other_furniture">Please specify:</label>
                <input type="text" id="other_furniture" name="other_furniture"
                       placeholder="e.g., Ottoman, Dresser, Bench, etc.">
            </div>

        </div>

        <div class="form-group">
            <label>What's your budget?</label>
            <div class="price-options">
                <div class="price-option">
                    <input type="radio" id="budget_under_2k" name="budget" value="₱0 - 1,999" required>
                    <label for="budget_under_2k">₱0 - 1,999<br><br></label>
                </div>
                <div class="price-option">
                    <input type="radio" id="budget_2k_4k" name="budget" value="₱2,000 - 3,999" required>
                    <label for="budget_2k_4k">₱2,000 - 3,999</label>
                </div>
                <div class="price-option">
                    <input type="radio" id="budget_4k_6k" name="budget" value="₱4,000 - 5,999" required>
                    <label for="budget_4k_6k">₱4,000 - 5,999</label>
                </div>
                <div class="price-option">
                    <input type="radio" id="budget_6k_8k" name="budget" value="₱6,000 - 7,999" required>
                    <label for="budget_6k_8k">₱6,000 - 7,999</label>
                </div>
                <div class="price-option">
                    <input type="radio" id="budget_over_8k" name="budget" value="₱8,000+" required>
                    <label for="budget_over_8k">₱8,000+</label>
                </div>
            </div>

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
                        <span class="text-xs text-gray-500">₱5-10k</span>
                        <span class="text-xs text-gray-500">₱10-20k</span>
                        <span class="text-xs text-gray-500">₱20-40k</span>
                        <span class="text-xs text-gray-500">₱40k+</span>
                    </div>
                </div>

                <!-- Budget ranges mapping (hidden) -->
                <div id="priceRanges" data-ranges='["₱0 - ₱5,000", "₱5,000 - ₱10,000", "₱10,000 - ₱20,000", "₱20,000 - ₱40,000", "₱40,000+"]'></div>
            </div>
        </div>

        <div class="form-group">
            <label for="style">What style do you prefer?</label>
            <select name="style" id="style" required>
                <option value="">Choose your preferred style...</option>

                <optgroup label="✨ Clean & Simple">
                    <option value="Modern">Modern - Clean lines, neutral colors</option>
                    <option value="Minimalist">Minimalist - Very simple, less clutter</option>
                    <option value="Scandinavian">Scandinavian - Simple + cozy (like IKEA)</option>
                    <option value="Contemporary">Contemporary - Current, trendy simple</option>
                </optgroup>

                <optgroup label="🏛️ Classic & Timeless">
                    <option value="Traditional">Traditional - Elegant, timeless pieces</option>
                    <option value="Transitional">Transitional - Classic with modern touch</option>
                    <option value="Victorian">Victorian - Ornate, detailed, luxurious</option>
                    <option value="French Country">French Country - Rustic elegance</option>
                </optgroup>

                <optgroup label="🕰️ Vintage & Retro">
                    <option value="Mid-Century Modern">Mid-Century - 1950s/60s retro style</option>
                    <option value="Industrial">Industrial - Factory/warehouse look</option>
                    <option value="Art Deco">Art Deco - 1920s glam, geometric</option>
                    <option value="Retro">Retro - 70s/80s nostalgic</option>
                </optgroup>

                <optgroup label="🏡 Natural & Rustic">
                    <option value="Rustic">Rustic - Farmhouse, natural wood</option>
                    <option value="Farmhouse">Farmhouse - Country living comfort</option>
                    <option value="Cottage">Cottage - Charming, quaint, cozy</option>
                    <option value="Japanese">Japanese - Zen, peaceful, natural</option>
                </optgroup>

                <optgroup label="🎨 Colorful & Creative">
                    <option value="Bohemian">Bohemian - Colorful, mixed patterns</option>
                    <option value="Eclectic">Eclectic - Mixed styles creatively</option>
                    <option value="Tropical">Tropical - Vibrant, plants, vacation vibe</option>
                    <option value="Maximalist">Maximalist - Bold, layered, dramatic</option>
                </optgroup>

                <optgroup label="🌊 Fresh & Airy">
                    <option value="Coastal">Coastal - Beach house, light colors</option>
                    <option value="Hamptons">Hamptons - Classic beach elegance</option>
                    <option value="Mediterranean">Mediterranean - Sunny, warm, textured</option>
                    <option value="California Casual">California Casual - Relaxed, indoor-outdoor</option>
                </optgroup>
            </select>
        </div>

        <button type="submit" id="submitBtn">Generate My Collection</button>
        <div class="mt-6">
            <p class="text-center text-gray-500 text-xs">Data based on <a href="https://ourhome.ph/collections/furniture" class="text-blue-500" target="_blank">ourhome.ph</a></p>
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