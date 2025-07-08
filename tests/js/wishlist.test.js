/**
 * @jest-environment jsdom
 */

import { Wishlist } from '../../resources/js/wishlist';

describe('Wishlist Module', () => {
    beforeEach(() => {
        // Setup localStorage mock
        Object.defineProperty(window, 'localStorage', {
            value: {
                getItem: jest.fn(),
                setItem: jest.fn(),
                removeItem: jest.fn(),
                clear: jest.fn()
            },
            writable: true
        });

        // Setup DOM elements
        document.body.innerHTML = `
            <div id="wishlist-count"></div>
            <div id="wishlist-preview"></div>
            <div id="full-wishlist"></div>
            <div id="empty-wishlist-message" class="hidden"></div>
        `;
    });

    test('should add item to wishlist', () => {
        // Mock localStorage.getItem to return empty wishlist
        window.localStorage.getItem.mockReturnValue(null);

        // Add item to wishlist
        Wishlist.add('1', 'Test Product', 'test.jpg', 'test-product');

        // Check if localStorage.setItem was called with correct arguments
        expect(window.localStorage.setItem).toHaveBeenCalledWith(
            'wishlist',
            expect.stringContaining('"1":{"id":"1","name":"Test Product","image":"test.jpg","slug":"test-product"')
        );
    });

    test('should remove item from wishlist', () => {
        // Mock localStorage.getItem to return wishlist with one item
        const mockWishlist = {
            '1': {
                id: '1',
                name: 'Test Product',
                image: 'test.jpg',
                slug: 'test-product',
                addedAt: Date.now()
            }
        };
        window.localStorage.getItem.mockReturnValue(JSON.stringify(mockWishlist));

        // Remove item from wishlist
        Wishlist.remove('1');

        // Check if localStorage.setItem was called with empty wishlist
        expect(window.localStorage.setItem).toHaveBeenCalledWith('wishlist', '{}');
    });
});
