describe('User Can Login', () => {
    it('User Can Open Login Page', () => {
        cy.visit("http://127.0.0.1:8000/login");
    });

    it('User Can Input Username and Password', () => {
        cy.visit("http://127.0.0.1:8000/login");
        cy.get('.mb-3.text-left > .col-form-label').should("have.text", "Username");
        cy.get('#username').type("aldi");
        cy.get('#password').type("password");
        cy.get('.btn').click();
    });

    it('User Can Forget Password', () => {
        cy.visit("http://127.0.0.1:8000/login");
        cy.get(':nth-child(4) > .py-1').visit("http://127.0.0.1:8000/password/reset");
        cy.get('#email').type("aldi@gmail.com");
        cy.get('.btn').click();
    });

    it('User Can Register New Account', () => {
        cy.visit("http://127.0.0.1:8000/login");
        cy.get(':nth-child(5) > .py-1').visit("http://127.0.0.1:8000/register");
        cy.get('#username').type("test1");
        cy.get('#email').type("test1@gmail.com");
        cy.get('#password').type("testdata123");
        cy.get('#password-confirm').type("testdata123");
        cy.get('.btn').click();
    })
})