const upperCaseLetters = [
    'A',
    'B',
    'C',
    'D',
    'E',
    'F',
    'G',
    'H',
    'I',
    'J',
    'K',
    'L',
    'M',
    'N',
    'O',
    'P',
    'Q',
    'R',
    'S',
    'T',
    'U',
    'V',
    'W',
    'X',
    'Y',
    'Z',
];
const lowerCaseLetters = [];
for (const letter of upperCaseLetters) {
    lowerCaseLetters.push(letter.toLowerCase());
}
const numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
const specialChars = ['!', '@', '#', '$', '%', '&', '*', '?', '.'];
const allowedChars = upperCaseLetters.concat(
    lowerCaseLetters,
    numbers,
    specialChars,
);

export default class FormValidator {
    constructor() {}

    /**
     * Validates the password.
     *
     * @param {string}  password The password that needs to be validated.
     *@returns Array with boolean and reason.
     */
    validatePassword(password) {
        const splitPassword = password.split('');

        const minCharacters = 8;
        const maxCharacters = 30;
        let hasUpperCase,
            hasLowerCase,
            hasNumber,
            hasSpecialCharacter,
            hasIllegalCharacter;

        if (password.length < minCharacters) {
            return [false, 'Password is too short'];
        } else if (password.length > maxCharacters) {
            return [false, 'Password is too long'];
        }
        console.log(lowerCaseLetters);
        for (const character of splitPassword) {
            console.log(character);
            if (upperCaseLetters.includes(character)) {
                hasUpperCase = true;
            } else if (lowerCaseLetters.includes(character)) {
                hasLowerCase = true;
            } else if (numbers.includes(character)) {
                hasNumber = true;
            } else if (specialChars.includes(character)) {
                hasSpecialCharacter = true;
            } else if (!allowedChars.includes(character)) {
                hasIllegalCharacter = true;
            }
        }
        // returns undefined????
        console.log(
            'uppercase:',
            hasUpperCase,
            'lowercase',
            hasLowerCase,
            'numbers',
            hasNumber,
            'specialchars',
            hasSpecialCharacter,
        );
        if (!hasUpperCase) {
            return [false, 'Password needs atleast 1 uppercase letter [A-Z].'];
        } else if (!hasLowerCase) {
            return [false, 'Password needs atleast 1 lowercase letter [a-z].'];
        } else if (!hasNumber) {
            return [false, 'Password needs atleast 1 number [0-9].'];
        } else if (!hasSpecialCharacter) {
            return [
                false,
                'Password needs atleast 1 special character (!, @ #, $, %, &, *, ?, .).',
            ];
        } else if (hasIllegalCharacter) {
            return [false, 'Password has an illegal character.'];
        } else {
            return [true, 'Password is valid.'];
        }
    }
    /**
     * Checks if postcode is in 1234XX format
     *
     * @param {string} postCode
     */
    postCodeValid(postCode) {
        if (postCode.length < 6) {
            return false;
        }
        let indexCorrect = false;

        for (let i = 0; i < 4; i++) {
            for (let num of numbers) {
                if (postCode.startsWith(num, i)) {
                    indexCorrect = true;
                    break;
                }
            }
            if (!indexCorrect) {
                return false;
            } else {
                indexCorrect = false;
            }
        }

        const letters = upperCaseLetters.concat(lowerCaseLetters);
        for (let i = 4; i < 6; i++) {
            for (let letter of letters) {
                if (postCode.startsWith(letter, i)) {
                    indexCorrect = true;
                    break;
                }
            }
            if (!indexCorrect) {
                return false;
            } else {
                indexCorrect = false;
            }
        }
        return true;
    }

    /**
     * Creates A Bootstrap warning Element.
     *
     * @param   string  The message the warning should display.
     */
    createWarningElement(string) {
        const warningEl = document.createElement('div');
        warningEl.classList = 'alert alert-warning';
        warningEl.role = 'alert';
        warningEl.textContent = string;
        return warningEl;
    }
}
