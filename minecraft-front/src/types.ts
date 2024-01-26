export interface CraftState {
    craftType: string;
    activeButton: string | null;
}

export interface Item {
    name: string;
    textureName: string;
}