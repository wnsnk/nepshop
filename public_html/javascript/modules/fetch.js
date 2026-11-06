export async function createUser(
    emailAddress,
    passWord,
    postCode,
    houseNumber,
    streetName,
    City,
) {
    try {
        const response = await fetch('/api/create_user.php', {
            method: 'POST',
            body: JSON.stringify({
                email: emailAddress,
                password: passWord,
                postcode: postCode,
                house_number: houseNumber,
                street_name: streetName,
                city: City,
            }),
        });
        if (!response.ok) {
            console.log();
            throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        console.log(result);
        window.location.href = 'log-in.php';
    } catch (error) {
        console.error(error.message);
    }
}

export async function logInUser(emailAddress, passWord) {
    try {
        const response = await fetch('/api/log_in.php', {
            method: 'POST',
            body: JSON.stringify({
                email: emailAddress,
                password: passWord,
            }),
        });
        if (!response.ok) {
            console.log();
            throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        // console.log(result);
        if (result['succes']) {
            document.location.href = '/';
        }
    } catch (error) {
        console.error(error.message);
    }
}
