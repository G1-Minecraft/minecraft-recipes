export interface CraftState {
    craftType: string;
    activeButton: string | null;
}

export interface Item {
    name: string,
    textureName: string,
    crafts: Craft[] | null,
    craftSlots: CraftSlots[] | null
}

export interface Craft {
    crafter: string,
    result: Item,
    resultAmount: number,
    craftSlots: CraftSlots[]
}

export interface CraftSlots {
    craft: Craft,
    item: Item,
    position: number
}