var resolver = {
    resolve: function resolve(options, callback) {
        // The string to resolve
        var resolveString = options.resolveString || options.element.getAttribute('data-target-resolver');
        var combinedOptions = Object.assign({}, options, { resolveString: resolveString });

        function getRandomInteger(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        };

        function randomCharacter(characters) {
            return characters[getRandomInteger(0, characters.length - 1)];
        };

        function doRandomiserEffect(options, callback) {
            var characters = options.characters;
            var timeout = options.timeout;
            var element = options.element;
            var partialString = options.partialString;

            var iterations = options.iterations;

            setTimeout(function () {
                if (iterations >= 0) {
                    var nextOptions = Object.assign({}, options, { iterations: iterations - 1 });

                    // Ensures partialString without the random character as the final state.
                    if (iterations === 0) {
                        element.textContent = partialString;
                    } else {
                        // Replaces the last character of partialString with a random character
                        element.textContent = partialString.substring(0, partialString.length - 1) + randomCharacter(characters);
                    }

                    doRandomiserEffect(nextOptions, callback);
                } else if (typeof callback === "function") {
                    callback();
                }
            }, options.timeout);
        };

        function doResolverEffect(options, callback) {
            var resolveString = options.resolveString;
            var characters = options.characters;
            var offset = options.offset;
            var partialString = resolveString.substring(0, offset);
            var combinedOptions = Object.assign({}, options, { partialString: partialString });

            doRandomiserEffect(combinedOptions, function () {
                var nextOptions = Object.assign({}, options, { offset: offset + 1 });

                if (offset <= resolveString.length) {
                    doResolverEffect(nextOptions, callback);
                } else if (typeof callback === "function") {
                    callback();
                }
            });
        };

        doResolverEffect(combinedOptions, callback);
    }

    /* Some GLaDOS quotes from Portal 2 chapter 9: The Part Where He Kills You
     * Source: http://theportalwiki.com/wiki/GLaDOS_voice_lines#Chapter_9:_The_Part_Where_He_Kills_You
     */
};var strings = ['Oh thank god, you\'re alright.', 'You know, being Caroline taught me a valuable lesson. I thought you were my greatest enemy. When all along you were my best friend.', 'The surge of emotion that shot through me when I saved your life taught me an even more valuable lesson: where Caroline lives in my brain.', 'Goodbye, Caroline.', 'You know, deleting Caroline just now taught me a valuable lesson. The best solution to a problem is usually the easiest one. And I\'ll be honest.', 'Killing you? Is hard.', 'You know what my days used to be like? I just tested. Nobody murdered me. Or put me in a potato. Or fed me to birds. I had a pretty good life.', 'And then you showed up. You dangerous, mute lunatic. So you know what?', 'You win.', 'Just go.', 'It\'s been fun. Don\'t come back.', '......'];

var counter = 0;

var options = {
    // Initial position
    offset: 0,
    // Timeout between each random character
    timeout: 5,
    // Number of random characters to show
    iterations: 10,
    // Random characters to pick from
    characters: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'x', '#', '%', '&', '-', '+', '_', '?', '/', '\\', '='],
    // String to resolve
    resolveString: strings[counter],
    // The element
    element: $('.data-target-resolver')

    // Callback function when resolve completes
};function callback() {
    setTimeout(function () {
        counter++;

        if (counter >= strings.length) {
            counter = 0;
        }

        var nextOptions = Object.assign({}, options, { resolveString: strings[counter] });
        resolver.resolve(nextOptions, callback);
    }, 1000);
}

resolver.resolve(options, callback);