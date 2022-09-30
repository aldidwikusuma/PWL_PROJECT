describe('Chair Table', () => {
    it('User Can Read Data in Chair Table', () => {
        cy.visit("http://127.0.0.1:8000/login");
        cy.get('.mb-3.text-left > .col-form-label').should("have.text", "Username");
        cy.get('#username').type("aldi");
        cy.get('#password').type("password");
        cy.get('.btn').click();
        cy.get(':nth-child(6) > .nav-link').visit("http://127.0.0.1:8000/dashboard/chairs");
    });

    it('User Can Create Data in Chair Table', () => {
        cy.visit("http://127.0.0.1:8000/login");
        cy.get('.mb-3.text-left > .col-form-label').should("have.text", "Username");
        cy.get('#username').type("aldi");
        cy.get('#password').type("password");
        cy.get('.btn').click();
        cy.get(':nth-child(6) > .nav-link').visit("http://127.0.0.1:8000/dashboard/chairs");
        cy.get('a.btn-primary').visit("http://127.0.0.1:8000/dashboard/chairs/create");
        cy.get('#name').type("K01");
        cy.get('.mb-5 > form > .btn').click();
    });

    it('User Can Update Data in Chair Table', () => {
        cy.visit("http://127.0.0.1:8000/login");
        cy.get('.mb-3.text-left > .col-form-label').should("have.text", "Username");
        cy.get('#username').type("aldi");
        cy.get('#password').type("password");
        cy.get('.btn').click();
        cy.get(':nth-child(6) > .nav-link').visit("http://127.0.0.1:8000/dashboard/chairs");
        cy.get(':nth-child(1) > :nth-child(3) > .btn-warning').click();
        cy.get('#name').type("A22");
        cy.get('.mb-5 > form > .btn').click();
    });

    it('User Can Delete Data in Chair Table', () => {
        cy.visit("http://127.0.0.1:8000/login");
        cy.get('.mb-3.text-left > .col-form-label').should("have.text", "Username");
        cy.get('#username').type("aldi");
        cy.get('#password').type("password");
        cy.get('.btn').click();
        cy.get(':nth-child(6) > .nav-link').visit("http://127.0.0.1:8000/dashboard/chairs");
        cy.get(':nth-child(1) > :nth-child(3) > .d-inline > .btn').click();
    });
})